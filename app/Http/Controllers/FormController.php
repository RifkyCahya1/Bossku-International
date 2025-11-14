<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function showCustomForm()
    {
        return view('custom-form');
    }
}
