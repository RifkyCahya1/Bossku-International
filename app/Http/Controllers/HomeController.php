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

    public function services(Request $request)
    {
        return view('services');
    }


    public function details()
    {
        return view('view-Details');
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
}
