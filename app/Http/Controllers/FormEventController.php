<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormEventController extends Controller
{
    public function showForm()
    {
        return view('formEvent');
    }
}
