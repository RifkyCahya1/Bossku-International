<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class AdminBookingsController extends Controller
{
    public function index()
    {
        $payments = Payment::latest()->paginate(10);
        return view('admin.booking', compact('payments'));
    }
    
    public function updateStatus($id, $status)
    {
        Payment::where('id', $id)->update([
            'status' => strtoupper($status)
        ]);

        return back();
    }
}
