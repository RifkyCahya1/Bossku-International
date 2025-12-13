<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Services\GeminiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TourController extends Controller
{
    private function formatItinerary($tourId, $json_day, GeminiService $ai)
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
                $b = $meal->bf != '0' ? "Breakfast" : "";
                $l = $meal->ln != '0' ? "Lunch" : "";
                $d = $meal->dn != '0' ? "Dinner" : "";
                $setMeal = "(" . implode(" ", array_filter([$b, $l, $d])) . ")";
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
                    "nama" => $ai->translateToEnglish($detail->tempat2 ?? ""),
                    "deskripsi" => $ai->translateToEnglish($detail->keterangan ?? ""),
                    "optional" => isset($ops->optional) && $ops->optional == 1
                ];
            }

            $hotel = DB::table('LT_add_pilihHotel')
                ->where('tour_id', $tourId)
                ->where('hari', $hari)
                ->first();

            $itinerary[] = [
                "hari" => $hari,
                "judul" => $ai->translateToEnglish($rute->nama ?? ""),
                "meal" => $setMeal,
                "tempat" => $tempat,
                "hotel" => isset($hotel->hotel) && $hotel->hotel == 1
            ];
        }

        return $itinerary;
    }



    private function baseImg($file)
    {
        if (!$file) return null;

        return asset('img/images/' . ltrim($file, '/'));
    }

    public function details($kode, GeminiService $ai)
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
            LEFT JOIN list_tempat AS lt ON lt.id = alt.id
            LEFT JOIN list_tempat_img AS lti ON lti.id = lt.id
            LEFT JOIN lt_add_meal AS am ON am.id = i.id
            WHERE i.kode = ?
            ORDER BY r.hari, alt.hari
            ",
            [$kode]
        );

        // ambil harga dasar
        $hargaDasar = (int)($data[0]->agent_twn ?? 0);

        // cari profit percent berdasarkan range harga
        $profitRow = DB::table('lt_itin_profit_range')
            ->where('price1', '<=', $hargaDasar)
            ->where('price2', '>=', $hargaDasar)
            ->first();

        $profitPercent = $profitRow->profit ?? 0;

        // final price
        $finalPrice = $hargaDasar + ($hargaDasar * ($profitPercent / 100));

        $tour = [
            "kode" => $kode,
            "name" => $data[0]->judul ?? "-",
            "kota" => $data[0]->kota ?? "-",
            "destination" => $data[0]->negara ?? "-",
            "duration" => $data[0]->durasi ?? "-",
            "price" => (int)$finalPrice,
            "base_price" => $hargaDasar,
            "profit_percent" => $profitPercent,
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
                $data[0]->id,      
                $data[0]->hari,
                $ai    
            ),
            "include" => explode('|', $data[0]->include ?? ''),
            "exclude" => explode('|', $data[0]->exclude ?? ''),
            "departure" => $data[0]->tanggal_berangkat ?? "-"
        ];

        

        return view('view-Details', [
            "tour" => $tour
        ]);
    }
}
