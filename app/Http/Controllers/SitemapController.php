<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\Models\Tour;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [];

        // ======================
        // STATIC PUBLIC PAGES
        // ======================
        $staticPages = [
            '/',
            '/Explore',
            '/About',
            '/Tour',
            '/Destination',
            '/Experience',
            '/FAQ',
            '/terms',
            '/privacy',
            '/Custom-Form',
            '/Booking',
            '/Partnership',
            '/form-event',
        ];

        foreach ($staticPages as $page) {
            $urls[] = [
                'loc' => url($page),
                'lastmod' => Carbon::now()->toAtomString(),
                'priority' => '0.8'
            ];
        }

        // ======================
        // PROVINCE (JSON)
        // ======================
        $jsonPath = public_path('JSON/province.json');

        if (File::exists($jsonPath)) {
            $provinces = json_decode(File::get($jsonPath), true);

            foreach ($provinces as $province) {
                if (!empty($province['name_en'])) {
                    $urls[] = [
                        'loc' => url('/Province/' . strtolower($province['name_en'])),
                        'lastmod' => Carbon::now()->toAtomString(),
                        'priority' => '0.7'
                    ];
                }
            }
        }

        // ======================
        // TOUR DETAIL (MODEL ADA)
        // ======================
        foreach (Tour::all() as $tour) {
            $urls[] = [
                'loc' => url('/tour/detail/' . $tour->kode),
                'lastmod' => $tour->updated_at
                    ? $tour->updated_at->toAtomString()
                    : now()->toAtomString(),
                'priority' => '0.9'
            ];
        }



        return response()
            ->view('sitemap', compact('urls')) // Now points to sitemap.php
            ->header('Content-Type', 'application/xml');
    }
}
