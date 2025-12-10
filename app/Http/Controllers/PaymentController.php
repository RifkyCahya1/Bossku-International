<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentStatusMail;

class PaymentController extends Controller
{
    public function createDoku(Request $req)
    {
        $invoice = 'INV-' . time();

        // Simpan ke DB sebagai UNPAID
        Payment::create([
            'invoice_number' => $invoice,
            'name'           => $req->name,
            'email'          => $req->email,
            'phone'          => $req->phone,
            'tour_name'      => $req->tour_name,
            'date'           => $req->date,
            'guests'         => $req->guests,
            'total'          => $req->total,
            'status'         => 'UNPAID',
        ]);

        // Payload API DOKU
        $payload = [
            "order" => [
                "invoice_number" => $invoice,
                "amount"         => (int) $req->total
            ],
            "payment" => [
                "payment_due_date" => 60,
                "allowed_payment_methods" => [
                    "VIRTUAL_ACCOUNT_BCA",
                    "VIRTUAL_ACCOUNT_BANK_MANDIRI",
                    "VIRTUAL_ACCOUNT_BANK_SYARIAH_MANDIRI",
                    "VIRTUAL_ACCOUNT_DOKU",
                    "VIRTUAL_ACCOUNT_BRI",
                    "VIRTUAL_ACCOUNT_BNI",
                    "VIRTUAL_ACCOUNT_BANK_PERMATA",
                    "VIRTUAL_ACCOUNT_BANK_CIMB",
                    "VIRTUAL_ACCOUNT_BANK_DANAMON",
                    "ONLINE_TO_OFFLINE_ALFA",
                    "CREDIT_CARD",
                    "DIRECT_DEBIT_BRI",
                    "EMONEY_SHOPEEPAY",
                    "EMONEY_OVO",
                    "QRIS",
                    "PEER_TO_PEER_AKULAKU",
                    "PEER_TO_PEER_KREDIVO",
                    "PEER_TO_PEER_INDODANA"
                ]
            ],
            "customer" => [
                "name"  => $req->name,
                "email" => $req->email,
                "phone" => $req->phone
            ],
            "callback_url" => url('/payment/doku/callback'),
            "return_url" => url('http://127.0.0.1:8000')
        ];

        $res = $this->callDoku($payload);

        // Log
        Log::info("DOKU RESPONSE", $res);

        if (!isset($res['response']['payment']['url'])) {
            return response()->json([
                "error" => "DOKU_GATEWAY_ERROR",
                "raw"   => $res
            ], 500);
        }

        return response()->json([
            "redirect_url" => $res['response']['payment']['url']
        ]);
    }

    // ==================================================
    // CALL DOKU API
    // ==================================================
    private function callDoku($payload)
    {
        $clientId = env('DOKU_CLIENT_ID');
        $secret   = env('DOKU_SECRET_KEY');

        $body = json_encode($payload, JSON_UNESCAPED_SLASHES);
        $timestamp = gmdate("Y-m-d\TH:i:s\Z");
        $requestId = (string) time();

        $signature = $this->makeSignatureForRequest(
            $body,
            $secret,
            $clientId,
            $requestId,
            $timestamp
        );

        Log::info("BODY SENT", ['body' => $body]);
        Log::info("SIGNATURE", ['sig' => $signature]);

        $response = Http::withHeaders([
            "Content-Type"       => "application/json",
            "Client-Id"          => $clientId,
            "Request-Id"         => $requestId,
            "Request-Timestamp"  => $timestamp,
            "Signature"          => $signature,
        ])->withBody($body, 'application/json')
            ->post("https://api-sandbox.doku.com/checkout/v1/payment");

        return $response->json();
    }

    private function makeSignatureForRequest($body, $secret, $clientId, $requestId, $timestamp)
    {
        $digest = base64_encode(hash("sha256", $body, true));

        $stringToSign =
            "Client-Id:$clientId\n" .
            "Request-Id:$requestId\n" .
            "Request-Timestamp:$timestamp\n" .
            "Request-Target:/checkout/v1/payment\n" .
            "Digest:$digest";

        Log::info("DOKU_SIGNATURE_DEBUG", [
            "body"          => $body,
            "digest"        => $digest,
            "stringToSign"  => $stringToSign,
        ]);

        return "HMACSHA256=" . base64_encode(
            hash_hmac("sha256", $stringToSign, $secret, true)
        );
    }



    // ==================================================
    // DOKU CALLBACK (WEBHOOK)
    // ==================================================
    public function callback(Request $req)
    {
        Log::info('DOKU CALLBACK RAW', [
            'headers' => $req->headers->all(),
            'body'    => $req->getContent()
        ]);

        $incomingSig = $req->header('Signature');

        if (!$this->validateCallbackSignature($req->getContent(), $incomingSig)) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $data = $req->all();
        $invoice = $data['order']['invoice_number'];
        $status  = $data['transaction']['status'];

        $payment = Payment::where('invoice_number', $invoice)->first();

        if (!$payment) {
            return response()->json(['message' => 'Invoice not found'], 404);
        }

        if ($status === 'SUCCESS') {
            $payment->update(['status' => 'PAID']);

            // === KIRIM NOTIFIKASI EMAIL ===
            Mail::to($payment->email)->send(new PaymentStatusMail($payment));
        } else if ($status === 'FAILED') {
            $payment->update(['status' => 'FAILED']);

            Mail::to($payment->email)->send(new PaymentStatusMail($payment));
        } else if ($status === 'PENDING') {
            $payment->update(['status' => 'PENDING']);

            Mail::to($payment->email)->send(new PaymentStatusMail($payment));
        }

        return response()->json(['message' => 'OK']);
    }


    private function validateCallbackSignature($rawBody, $incomingSig)
    {
        $secret = env('DOKU_SECRET_KEY');

        $calcSign = "HMACSHA256=" . base64_encode(
            hash_hmac('sha256', $rawBody, $secret, true)
        );

        return hash_equals($calcSign, $incomingSig);
    }


    public function processing(Request $req)
    {
        return view('payment.processing', [
            'invoice' => $req->invoice
        ]);
    }

    public function checkStatus($invoice)
    {
        $payment = Payment::where('invoice_number', $invoice)->first();

        if (!$payment) {
            return response()->json(['status' => 'NOT_FOUND']);
        }

        return response()->json([
            'status' => $payment->status
        ]);
    }
}
