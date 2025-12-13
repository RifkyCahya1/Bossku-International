<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AttractionController extends Controller
{
    public function experience(Request $req)
    { 
        $experiences = DB::table('list_tempat as lt')
            ->leftJoin('list_tempat_img as lti', 'lt.id', '=', 'lti.tmp_id')
            ->select(
                'lt.id',
                'lt.tempat as name',
                'lt.city as location',
                'lt.price',
                'lt.keterangan',
                'lti.winter_img',
                'lti.autumn_img',
                'lti.summer_img'
            )
            ->where('lt.price', '>', 0)
            ->where('lt.negara', 'LIKE', '%INDONESIA%')
            ->where('lt.tempat', 'LIKE', '%WNA%')
            ->inRandomOrder()
            ->take(10)
            ->get();
 
        $all = DB::table('list_tempat as lt')
            ->leftJoin('list_tempat_img as lti', 'lt.id', '=', 'lti.tmp_id')
            ->select(
                'lt.id',
                'lt.tempat as name',
                'lt.city as location',
                'lt.price',
                'lt.keterangan',
                'lti.winter_img',
                'lti.autumn_img',
                'lti.summer_img'
            )
            ->where('lt.tempat', 'LIKE', '%WNA%')
            ->where('lt.price', '>', 0)
            ->where('lt.negara', 'LIKE', '%INDONESIA%');
 
        if ($req->search) {
            $all->where(function ($q) use ($req) {
                $q->where('lt.tempat', 'LIKE', '%' . $req->search . '%')
                    ->orWhere('lt.city', 'LIKE', '%' . $req->search . '%');
            });
        }
 
        if ($req->city) {
            $all->where('lt.city', $req->city);
        }
 
        if ($req->sort === 'low') {
            $all->orderBy('lt.price', 'asc');
        } elseif ($req->sort === 'high') {
            $all->orderBy('lt.price', 'desc');
        }
 
        $allProducts = $all->paginate(6)->withQueryString();
 
        $cities = DB::table('list_tempat')
            ->where('tempat', 'LIKE', '%WNA%')
            ->where('price', '>', 0)
            ->where('negara', 'LIKE', '%INDONESIA%')
            ->pluck('city')
            ->unique()
            ->sort()
            ->values();

        return view('experience', compact('experiences', 'allProducts', 'cities'));
    }


    public function show($id)
    {
        $attraction = DB::table('list_tempat as lt')
            ->leftJoin('list_tempat_img as lti', 'lt.id', '=', 'lti.tmp_id')
            ->select(
                'lt.id',
                'lt.tempat as name',
                'lt.city',
                'lt.price',
                'lt.keterangan',
                'lti.winter_img',
                'lti.autumn_img',
                'lti.summer_img'
            )
            ->where('lt.id', $id)
            ->first();

        return view('show', compact('attraction'));
    }
}
