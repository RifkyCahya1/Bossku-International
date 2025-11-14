<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProvinceController extends Controller
{
    public function show($province)
    {
        $jsonPath = public_path('JSON/province.json');

        if (!File::exists($jsonPath)) {
            abort(404, 'Data file not found.');
        }

        $provinces = json_decode(File::get($jsonPath), true);

        $data = collect($provinces)->first(function ($p) use ($province) {
            return strtolower($p['name_en']) === strtolower($province);
        });

        if (!$data) {
            abort(404, 'Province not found.');
        }

        return view('province', compact('data'));
    }
}
