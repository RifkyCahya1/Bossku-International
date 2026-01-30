<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Mail\SubscriptionConfirmation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        // Validasi email
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:boss_subscribers,email'
        ], [
            'email.unique' => 'This email is already subscribed.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first('email')
            ], 422);
        }

        try {
            // Simpan ke database
            $subscriber = Subscriber::create([
                'email' => $request->email,
                'subscribed_at' => now(),
            ]);

            // Kirim email konfirmasi
            try {
                Mail::to($request->email)->send(new SubscriptionConfirmation($request->email));
                Log::info('Confirmation email sent to: ' . $request->email);
            } catch (\Exception $emailException) {
                Log::error('Failed to send confirmation email: ' . $emailException->getMessage());
                // Lanjutkan meskipun email gagal dikirim
            }

            return response()->json([
                'success' => true,
                'message' => 'Thank you for subscribing! A confirmation email has been sent to your inbox.'
            ]);
        } catch (\Exception $e) {
            Log::error('Subscription error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }
}
