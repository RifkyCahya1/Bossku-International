<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function explore()
    {
        return view('explore-indonesia');
    }

    public function provinsi()
    {
        return view('province');
    }

    public function indonesia()
    {
        $base = DB::table('LT_itinerary2 as iti')
            ->leftJoin('LT_itinnew as det', 'det.kode', '=', 'iti.landtour')
            ->leftJoin('LT_itin_profit_range as pr', function ($join) {
                $join->whereColumn('det.agent_twn', '>=', 'pr.price1')
                    ->whereColumn('det.agent_twn', '<=', 'pr.price2');
            })
            ->where('det.negara', 'INDONESIA')
            ->where('det.agent_twn', '>', 0)
            ->where('det.pax', '<', 10)
            ->select(
                'iti.judul',
                'iti.id as itinerary_id',
                'iti.gambar1',
                'iti.gambar2',
                'iti.gambar3',
                'iti.gambar4',
                'det.kota',
                'iti.landtour',
                'det.kurs',
                'det.agent_twn as harga_dasar',
                'pr.profit as profit_percent',
                'det.agent_cnb',
                'det.pax',
                'det.expired',
                'det.statuss',
                'det.benua',
                'det.negara'
            )
            ->orderBy('iti.id')
            ->get();

        // === HILANGKAN DUPLIKASI BERDASARKAN judul + landtour ===
        $base = $base
            ->groupBy(fn($item) => $item->judul . '|' . $item->landtour)
            ->map(fn($g) => $g->first())
            ->values();

        // === Hitung harga & ambil gambar ===
        $tours = $base->map(function ($t) {
            $harga  = (int) $t->harga_dasar;
            $profit = (int) ($t->profit_percent ?? 0);
            $t->harga_final = $harga + ($harga * ($profit / 100));

            $t->image = $this->getValidImage(
                $t->gambar1,
                $t->gambar2,
                $t->gambar3,
                $t->gambar4
            );

            return $t;
        });

        return view('services', compact('tours'));
    }


    private function getValidImage(...$files)
    {
        foreach ($files as $file) {

            if (!$file) continue;

            // Path di storage / folder public
            $path = public_path('img/images/' . $file);

            if (file_exists($path)) {
                return asset('img/images/' . $file);
            }
        }

        return asset('img/ExploreIndonesia.jpg');
    }



    public function destination()
    {
        return view('destination');
    }

    public function experience()
    {
        return view('experience');
    }

    public function booking()
    {
        return view('booking-form');
    }

    public function about()
    {
        return view('about');
    }

    public function customForm()
    {
        return view('customtrip');
    }
}
