<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentDokuController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'date' => 'required',
            'guests' => 'required',
            'total' => 'required|numeric',
            'tour_id' => 'required',
        ]);

        try {
            $client_id      = env('DOKU_CLIENT_ID');
            $secret_key     = env('DOKU_SECRET_KEY');
            $invoice_number = 'INV-' . time();

            $payload = [
                "order" => [
                    "amount" => $request->total,
                    "invoice_number" => $invoice_number,
                    "currency" => "IDR"
                ],
                "customer" => [
                    "name" => $request->name,
                    "email" => $request->email,
                    "phone" => $request->phone,
                ],
                "merchant" => [
                    "id" => $client_id
                ],
                "callback" => [
                    "finish" => url('/payment/doku/finish'),
                    "notify" => url('/payment/doku/notify'),
                ]
            ];

            $isoTime = gmdate("Y-m-d\TH:i:s\Z");
            $digest  = base64_encode(hash('sha256', json_encode($payload), true));
            $signature = base64_encode(
                hash_hmac('sha256', "Client-Id:$client_id\nRequest-Id:$invoice_number\nRequest-Timestamp:$isoTime\nRequest-Target:/checkout/v1/payment\nDigest:$digest", $secret_key, true)
            );

            $response = Http::withHeaders([
                'Client-Id' => $client_id,
                'Request-Id' => $invoice_number,
                'Request-Timestamp' => $isoTime,
                'Signature' => "HMACSHA256=$signature",
                'Content-Type' => 'application/json',
            ])->post('https://api-sandbox.doku.com/checkout/v1/payment', $payload);

            if ($response->failed()) {
                return response()->json([
                    "error" => true,
                    "message" => "Failed to connect to DOKU",
                    "debug" => $response->body()
                ], 500);
            }

            $data = $response->json();

            return response()->json([
                "redirect_url" => $data['response']['payment']['url'] ?? null
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "error" => true,
                "message" => $e->getMessage()
            ], 500);
        }
    }

    public function finish()
    {
        return "Payment Completed!";
    }

    public function notify(Request $request)
    {
        return response()->json(["status" => "ok"]);
    }
}
