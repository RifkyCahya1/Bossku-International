<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class TourController extends Controller
{
    private function formatItinerary($tourId, $json_day)
    {
        $itinerary = [];

        for ($hari = 1; $hari <= $json_day; $hari++) {

            $rute = DB::table('LT_add_rute')
                ->where('tour_id', $tourId)
                ->where('hari', $hari)
                ->first();

            $meal = DB::table('LT_add_meal')
                ->where('tour_id', $tourId)
                ->where('hari', $hari)
                ->first();

            $setMeal = "";
            if ($meal && ($meal->bf != '0' || $meal->ln != '0' || $meal->dn != '0')) {
                $b = $meal->bf != '0' ? "B" : "";
                $l = $meal->ln != '0' ? "L" : "";
                $d = $meal->dn != '0' ? "D" : "";
                $setMeal = "(" . $b . " " . $l . " " . $d . ")";
            }

            $listTmp = DB::table('LT_add_listTmp')
                ->where('tour_id', $tourId)
                ->where('hari', $hari)
                ->orderBy('urutan', 'ASC')
                ->get();

            $tempat = [];
            foreach ($listTmp as $tmp) {
                $detail = DB::table('List_tempat')->where('id', $tmp->tempat)->first();

                $ops = DB::table('LT_add_ops')
                    ->where('master_id', $tourId)
                    ->where('hari', $hari)
                    ->where('urutan', $tmp->urutan)
                    ->first();

                $tempat[] = [
                    "nama" => $detail->tempat2 ?? "",
                    "deskripsi" => $detail->keterangan ?? "",
                    "optional" => isset($ops->optional) && $ops->optional == 1
                ];
            }

            $hotel = DB::table('LT_add_pilihHotel')
                ->where('tour_id', $tourId)
                ->where('hari', $hari)
                ->first();

            $itinerary[] = [
                "hari" => $hari,
                "judul" => $rute->nama ?? "",
                "meal" => $setMeal,
                "tempat" => $tempat,
                "hotel" => isset($hotel->hotel) && $hotel->hotel == 1,
            ];
        }

        return $itinerary;
    }

    private function getKursUsd()
    {
        try {
            // Ambil data terbaru dari tabel kurs_bca_field
            // Kolom 'nama' berisi kode mata uang seperti 'USD', 'Jual' adalah kurs jual
            $kurs = DB::table('kurs_bca_field')
                ->where('nama', 'USD') // Filter untuk USD
                ->orderBy('tgl', 'desc') // Urutkan berdasarkan tanggal terbaru
                ->first();

            // Debug: Lihat data yang diambil
            Log::info('Data kurs dari database:', ['kurs' => $kurs]);

            if ($kurs) {
                // Gunakan kolom 'Jual' (kurs jual) untuk konversi IDR ke USD
                // Karena untuk mengkonversi IDR ke USD, kita butuh kurs jual (bank menjual USD)
                $kursValue = $kurs->Jual ?? $kurs->jual ?? 0;

                Log::info('Nilai kurs Jual ditemukan:', ['jual' => $kursValue]);

                return (float)$kursValue;
            }

            Log::warning('Data kurs USD tidak ditemukan, menggunakan default 15000');
            return 15000; // Default jika tidak ada data
        } catch (\Exception $e) {
            Log::error('Error getting USD kurs: ' . $e->getMessage());
            return 15000; // Default jika error
        }
    }

    private function baseImg($file)
    {
        if (!$file) return null;

        return asset('img/images/' . ltrim($file, '/'));
    }

    public function details($kode)
    {
        $data = DB::select(
            "
        SELECT 
            i.*,
            it.*,
            alt.hari AS tempat_hari,
            lt.tempat,
            lt.tempat2,
            lt.keterangan AS deskripsi_tempat,
            lti.link,
            lti.summer_img,
            lti.winter_img,
            lti.autumn_img,
            am.hari AS meal_hari,
            am.ln,
            am.dn,
            am.ket
        FROM lt_itinnew AS i
        LEFT JOIN lt_itinerary2 AS it ON it.landtour = i.kode
        LEFT JOIN lt_rute AS r ON r.id = i.id
        LEFT JOIN lt_add_rute AS ar ON ar.id = r.id
        LEFT JOIN lt_add_listtmp AS alt ON alt.id = i.id
        LEFT JOIN List_tempat AS lt ON lt.id = alt.id
        LEFT JOIN list_tempat_img AS lti ON lti.id = lt.id
        LEFT JOIN lt_add_meal AS am ON am.id = i.id
        WHERE i.kode = ?
        ORDER BY r.hari, alt.hari
        ",
            [$kode]
        );

        if (empty($data)) {
            abort(404, 'Tour not found');
        }

        // ambil harga dasar
        $hargaDasar = (int)($data[0]->agent_twn ?? 0);

        // Get USD kurs
        $kursUsd = $this->getKursUsd();

        // Debug: Tampilkan nilai kurs untuk testing
        Log::info("Kurs USD digunakan: {$kursUsd}");

        // Ambil data kurs dari database untuk ditampilkan
        $kursData = DB::table('kurs_bca_field')
            ->where('nama', 'USD')
            ->orderBy('tgl', 'desc')
            ->first();

        // cari profit percent berdasarkan range harga
        $profitRow = DB::table('lt_itin_profit_range')
            ->where('price1', '<=', $hargaDasar)
            ->where('price2', '>=', $hargaDasar)
            ->first();

        $profitPercent = $profitRow->profit ?? 0;

        // final price dalam IDR
        $finalPrice = $hargaDasar + ($hargaDasar * ($profitPercent / 100));

        // Konversi ke USD
        $finalPriceUsd = $kursUsd > 0 ? round($finalPrice / $kursUsd, 2) : 0;

        $tour = [
            "kode" => $kode,
            "name" => $data[0]->judul ?? "-",
            "kota" => $data[0]->kota ?? "-",
            "destination" => $data[0]->negara ?? "-",
            "duration" => $data[0]->durasi ?? "-",
            "price" => (int)$finalPrice, // Harga dalam IDR
            "price_usd" => $finalPriceUsd, // Harga dalam USD
            "base_price" => $hargaDasar,
            "profit_percent" => $profitPercent,
            "kurs_usd" => $kursUsd, // Nilai kurs yang digunakan
            "kurs_date" => $kursData->tgl ?? date('Y-m-d'), // Tanggal kurs (gunakan tgl bukan date)
            "kurs_jual" => $kursData->Jual ?? 0, // Nilai jual
            "kurs_beli" => $kursData->Beli ?? 0, // Nilai beli
            "rating" => 5,
            "gallery" => array_filter([
                $this->baseImg($data[0]->link ?? $data[0]->gambar1),
                $this->baseImg($data[0]->summer_img ?? $data[0]->gambar2),
                $this->baseImg($data[0]->winter_img ?? $data[0]->gambar3),
                $this->baseImg($data[0]->autumn_img ?? $data[0]->gambar4),
            ]),
            "description" => $data[0]->deskripsi_singkat ?? "-",
            "category" => $data[0]->kategori ?? "Tour",
            "type" => $data[0]->tipe ?? "Group",
            "itinerary" => $this->formatItinerary(
                $data[0]->id,          // tour_id
                $data[0]->hari      // jumlah hari itinerary
            ),
            "include" => explode('|', $data[0]->include ?? ''),
            "exclude" => explode('|', $data[0]->exclude ?? ''),
            "departure" => $data[0]->tanggal_berangkat ?? "-"
        ];

        return view('view-Details', [
            "tour" => $tour
        ]);
    }

    public function send(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        Mail::raw("Name: {$req->name}\nEmail: {$req->email}\n\nMessage:\n{$req->message}", function ($mail) use ($req) {
            $mail->to("rifkycahyaputraa@gmail.com")
                ->subject("New Inquiry from Website");
        });

        return response()->json(['message' => 'Email sent']);
    }
}
