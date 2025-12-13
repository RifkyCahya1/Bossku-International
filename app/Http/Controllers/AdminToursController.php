<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class AdminToursController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // 1. Ambil semua dulu (no pagination)
        $base = DB::table('LT_itinerary2 as iti')
            ->leftJoin('LT_itinnew as det', 'det.kode', '=', 'iti.landtour')
            ->leftJoin('LT_itin_profit_range as pr', function ($join) {
                $join->whereColumn('det.agent_twn', '>=', 'pr.price1')
                    ->whereColumn('det.agent_twn', '<=', 'pr.price2');
            })
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q2) use ($search) {
                    $q2->where('iti.judul', 'LIKE', "%{$search}%")
                        ->orWhere('det.kota', 'LIKE', "%{$search}%")
                        ->orWhere('iti.landtour', 'LIKE', "%{$search}%");
                });
            })
            ->where('det.negara', 'INDONESIA')
            ->where('det.agent_twn', '>', 0)
            ->where('det.pax', '<', 4)
            ->orderBy('iti.id')
            ->get();

        // 2. Anti duplikasi judul + landtour
        $base = $base
            ->groupBy(fn($item) => $item->judul . '|' . $item->landtour)
            ->map(fn($g) => $g->first())
            ->values();

        $activeCount = $base->count();

        // 3. Manual paginate
        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;

        $tours = new LengthAwarePaginator(
            $base->slice(($page - 1) * $perPage, $perPage)->values(),
            $base->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('admin.tours', compact('tours', 'search', 'activeCount'));
    }
}
