<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentStatusMail;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Create DOKU payment request
     */
    public function createDoku(Request $req)
    {
        $invoice = 'INV-' . time();

        // Create payment record
        $payment = Payment::create([
            'invoice_number' => $invoice,
            'name'           => $req->name,
            'email'          => $req->email,
            'phone'          => $req->phone,
            'tour_id'        => $req->tour_id,
            'tour_name'      => $req->tour_name,
            'date'           => $req->date,
            'guests'         => $req->guests,
            'total'          => $req->total,
            'status'         => 'UNPAID',
        ]);

        // Payload untuk DOKU
        $payload = [
            "order" => [
                "invoice_number" => $invoice,
                "amount"         => (int) $req->total,
                "line_items" => [
                    [
                        "name" => $req->tour_name,
                        "quantity" => $req->guests,
                        "price" => (int) ($req->total / $req->guests)
                    ]
                ]
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
                    "CREDIT_CARD",
                    "DIRECT_DEBIT_BRI",
                    "QRIS"
                ]
            ],
            "credit_card" => [
                "is_3ds" => true,
            ],
            "customer" => [
                "name"  => $req->name,
                "email" => $req->email,
                "phone" => $req->phone
            ],
            "additional_info" => [
                "allow_tenor" => [0, 3, 6, 12],
                "close_redirect" => url('/payment/return?invoice=' . $invoice),
            ],
            "return_url" => url('/payment/return?invoice=' . $invoice),
            "notify_url" => url('/payment/doku/notify')
        ];

        $res = $this->callDoku($payload);

        Log::channel('doku')->info('DOKU PAYMENT CREATED', [
            'invoice' => $invoice,
            'response_keys' => array_keys($res)
        ]);

        if (!isset($res['response']['payment']['url'])) {
            Log::channel('doku')->error('DOKU PAYMENT FAILED', $res);
            return response()->json([
                "error" => "DOKU_GATEWAY_ERROR",
                "message" => "Failed to create payment",
                "invoice" => $invoice
            ], 500);
        }

        // Simpan data response
        $payment->update([
            'session_id' => $res['response']['order']['session_id'] ?? null,
            'checkout_url' => $res['response']['payment']['url'],
            'expired_at' => $res['response']['payment']['expired_datetime'] ?? null
        ]);

        return response()->json([
            "redirect_url" => $res['response']['payment']['url'],
            "invoice" => $invoice,
            "expired_at" => $res['response']['payment']['expired_datetime'] ?? null
        ]);
    }

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

        $response = Http::timeout(30)->withHeaders([
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

        return "HMACSHA256=" . base64_encode(
            hash_hmac("sha256", $stringToSign, $secret, true)
        );
    }

    /**
     * Handle return from DOKU payment page
     */
    public function handleReturn(Request $req)
    {
        $invoice = $req->get('invoice');

        Log::channel('doku')->info('PAYMENT RETURN HANDLER', [
            'invoice' => $invoice,
            'all_params' => $req->all(),
            'ip' => $req->ip()
        ]);

        if (!$invoice) {
            Log::channel('doku')->error('NO INVOICE IN RETURN URL');
            return view('payment.error', [
                'message' => 'Invoice not found in return URL'
            ]);
        }

        $payment = Payment::where('invoice_number', $invoice)->first();

        if (!$payment) {
            Log::channel('doku')->error('PAYMENT NOT FOUND IN DATABASE', ['invoice' => $invoice]);
            return view('payment.error', [
                'message' => 'Payment record not found'
            ]);
        }

        // IMMEDIATELY check status from DOKU API
        $dokuStatus = $this->checkDokuStatus($invoice);

        if ($dokuStatus) {
            $this->updatePaymentFromDokuStatus($payment, $dokuStatus);
            $payment->refresh();
        }

        // Log result
        Log::channel('doku')->info('RETURN HANDLER COMPLETED', [
            'invoice' => $invoice,
            'status' => $payment->status,
            'payment_method' => $payment->payment_method
        ]);

        return view('payment.status', [
            'payment' => $payment,
            'invoice' => $invoice,
            'status_checked' => $dokuStatus ? true : false
        ]);
    }

    /**
     * Check payment status from DOKU API
     */
    private function checkDokuStatus($invoice)
    {
        try {
            $clientId = env('DOKU_CLIENT_ID');
            $secret = env('DOKU_SECRET_KEY');
            $timestamp = gmdate("Y-m-d\TH:i:s\Z");
            $requestId = 'status-check-' . time();

            $body = json_encode([
                "order" => [
                    "invoice_number" => $invoice
                ]
            ]);

            $digest = base64_encode(hash("sha256", $body, true));

            $stringToSign = "Client-Id:{$clientId}\n" .
                "Request-Id:{$requestId}\n" .
                "Request-Timestamp:{$timestamp}\n" .
                "Request-Target:/orders/v1/status\n" .
                "Digest:{$digest}";

            $signature = "HMACSHA256=" . base64_encode(
                hash_hmac("sha256", $stringToSign, $secret, true)
            );

            Log::channel('doku')->info('CHECKING DOKU STATUS', ['invoice' => $invoice]);

            $response = Http::timeout(15)->withHeaders([
                "Content-Type" => "application/json",
                "Client-Id" => $clientId,
                "Request-Id" => $requestId,
                "Request-Timestamp" => $timestamp,
                "Signature" => $signature,
            ])->withBody($body, 'application/json')
                ->post("https://api-sandbox.doku.com/orders/v1/status");

            $result = $response->json();

            Log::channel('doku')->info('DOUK STATUS RESPONSE', [
                'invoice' => $invoice,
                'has_transaction' => isset($result['transaction']),
                'has_payment' => isset($result['payment'])
            ]);

            return $result;
        } catch (\Exception $e) {
            Log::channel('doku')->error('DOUK STATUS CHECK FAILED', [
                'invoice' => $invoice,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }

    /**
     * Update payment based on DOKU status response
     */
    private function updatePaymentFromDokuStatus($payment, $dokuStatus)
    {
        // === STATUS (AMAN UNTUK CC JOKUL) ===
        $status =
            $dokuStatus['transaction']['status']
            ?? $dokuStatus['result']['status']
            ?? $dokuStatus['payment']['status']
            ?? $dokuStatus['status']
            ?? null;

        if (!$status) {
            Log::channel('doku')->warning('NO STATUS FOUND', [
                'invoice' => $payment->invoice_number,
                'keys' => array_keys($dokuStatus)
            ]);
            return;
        }

        // === PAYMENT METHOD ===
        $paymentMethod =
            $dokuStatus['channel']['id']
            ?? $dokuStatus['service']['id']
            ?? $dokuStatus['payment']['payment_method']
            ?? 'UNKNOWN';

        // === STATUS MAPPING ===
        $map = [
            'SUCCESS'    => 'PAID',
            'COMPLETED'  => 'PAID',
            'SETTLED'    => 'PAID',
            'CAPTURED'   => 'PAID',
            'AUTHORIZED' => 'PENDING',
            'CHALLENGE'  => 'PENDING',
            'PENDING'    => 'PENDING',
            'FAILED'     => 'FAILED',
            'DENIED'     => 'FAILED',
            'EXPIRED'    => 'FAILED',
            'REFUNDED'   => 'REFUNDED',
        ];

        $newStatus = $map[strtoupper($status)] ?? 'PENDING';

        if ($payment->status === $newStatus) {
            return;
        }

        $update = [
            'status'         => $newStatus,
            'payment_method' => $paymentMethod,
            'raw_response'   => json_encode($dokuStatus),
            'last_status_check' => now(),
        ];

        // === KHUSUS CREDIT CARD ===
        if (isset($dokuStatus['card_payment'])) {
            $update['authorization_code'] =
                $dokuStatus['card_payment']['approval_code'] ?? null;

            $update['card_info'] = json_encode([
                'masked' => $dokuStatus['card_payment']['masked_card_number'] ?? null,
                'brand'  => $dokuStatus['card_payment']['brand'] ?? null,
                'issuer' => $dokuStatus['card_payment']['issuer'] ?? null,
                'tenor'  => $dokuStatus['card_payment']['tenor'] ?? null,
            ]);
        }

        if ($newStatus === 'PAID') {
            $update['paid_at'] = now();
        }

        $payment->update($update);

        Log::channel('doku')->info('PAYMENT UPDATED', [
            'invoice' => $payment->invoice_number,
            'from' => $payment->getOriginal('status'),
            'to' => $newStatus,
            'method' => $paymentMethod
        ]);

        if (in_array($newStatus, ['PAID', 'FAILED'])) {
            $this->sendPaymentEmail($payment);
        }
    }

    public function notify(Request $req)
    {
        $raw = $req->getContent();
        Log::channel('doku')->info('DOKU NOTIFY RAW', [
            'body' => $raw,
            'headers' => $req->headers->all()
        ]);

        $data = json_decode($raw, true);
        if (!is_array($data)) {
            return response()->json(['message' => 'OK'], 200);
        }

        $invoice =
            $data['order']['invoice_number']
            ?? $data['invoice_number']
            ?? null;

        if (!$invoice) {
            Log::channel('doku')->warning('NO INVOICE IN NOTIFY');
            return response()->json(['message' => 'OK'], 200);
        }

        $payment = Payment::where('invoice_number', $invoice)->first();
        if (!$payment) {
            Log::channel('doku')->warning('PAYMENT NOT FOUND', ['invoice' => $invoice]);
            return response()->json(['message' => 'OK'], 200);
        }

        $this->updatePaymentFromDokuStatus($payment, $data);

        return response()->json(['message' => 'OK'], 200);
    }

    private function processNotification($invoice, $data)
    {
        $payment = Payment::where('invoice_number', $invoice)->first();
        if (!$payment) {
            Log::channel('doku')->error('NOTIFICATION: PAYMENT NOT FOUND', ['invoice' => $invoice]);
            return;
        }

        $this->updatePaymentFromDokuStatus($payment, $data);
    }

    /**
     * API endpoint to check payment status
     */
    public function checkStatus($invoice)
    {
        $payment = Payment::where('invoice_number', $invoice)->first();

        if (!$payment) {
            return response()->json([
                'error' => 'Payment not found',
                'invoice' => $invoice
            ], 404);
        }

        // Check status from DOKU
        $dokuStatus = $this->checkDokuStatus($invoice);

        if ($dokuStatus) {
            $this->updatePaymentFromDokuStatus($payment, $dokuStatus);
            $payment->refresh();
        }

        return response()->json([
            'invoice' => $invoice,
            'status' => $payment->status,
            'payment_method' => $payment->payment_method,
            'paid_at' => $payment->paid_at,
            'last_checked' => $payment->last_status_check,
            'checked_count' => $payment->status_checked_count ?? 0
        ]);
    }

    /**
     * Scheduled task to check pending payments
     */
    public function checkPendingPayments()
    {
        Log::channel('doku')->info('STARTING SCHEDULED CHECK');

        $pendingPayments = Payment::where('status', 'PENDING')
            ->where('created_at', '>', now()->subHours(24))
            ->get();

        $checked = 0;
        $updated = 0;

        foreach ($pendingPayments as $payment) {
            $checked++;

            // Skip if checked recently (within 5 minutes)
            if (
                $payment->last_status_check &&
                $payment->last_status_check->diffInMinutes(now()) < 5
            ) {
                continue;
            }

            Log::channel('doku')->info('Checking pending payment', [
                'invoice' => $payment->invoice_number,
                'created_at' => $payment->created_at
            ]);

            $dokuStatus = $this->checkDokuStatus($payment->invoice_number);

            if ($dokuStatus) {
                $oldStatus = $payment->status;
                $this->updatePaymentFromDokuStatus($payment, $dokuStatus);
                $payment->refresh();

                if ($payment->status !== $oldStatus) {
                    $updated++;
                    Log::channel('doku')->info('Payment status changed', [
                        'invoice' => $payment->invoice_number,
                        'from' => $oldStatus,
                        'to' => $payment->status
                    ]);
                }
            }

            // Small delay to avoid rate limiting
            if ($checked < count($pendingPayments)) {
                sleep(1);
            }
        }

        Log::channel('doku')->info('SCHEDULED CHECK COMPLETED', [
            'checked' => $checked,
            'updated' => $updated,
            'total_pending' => $pendingPayments->count()
        ]);

        return response()->json([
            'checked' => $checked,
            'updated' => $updated,
            'total' => $pendingPayments->count(),
            'timestamp' => now()->toDateTimeString()
        ]);
    }

    /**
     * Manual status update endpoint (for admin/testing)
     */
    public function manualUpdate(Request $req, $invoice)
    {
        $payment = Payment::where('invoice_number', $invoice)->first();

        if (!$payment) {
            return response()->json(['error' => 'Payment not found'], 404);
        }

        // Force check from DOKU
        $dokuStatus = $this->checkDokuStatus($invoice);

        if ($dokuStatus) {
            $this->updatePaymentFromDokuStatus($payment, $dokuStatus);
            $payment->refresh();
        }

        return response()->json([
            'success' => true,
            'invoice' => $invoice,
            'status' => $payment->status,
            'payment_method' => $payment->payment_method,
            'paid_at' => $payment->paid_at,
            'doku_response' => $dokuStatus ? 'Received' : 'Failed'
        ]);
    }

    /**
     * Get payment details
     */
    public function getPayment($invoice)
    {
        $payment = Payment::where('invoice_number', $invoice)->first();

        if (!$payment) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json([
            'invoice' => $payment->invoice_number,
            'name' => $payment->name,
            'email' => $payment->email,
            'tour_name' => $payment->tour_name,
            'total' => $payment->total,
            'status' => $payment->status,
            'payment_method' => $payment->payment_method,
            'paid_at' => $payment->paid_at,
            'created_at' => $payment->created_at,
            'expired_at' => $payment->expired_at
        ]);
    }

    /**
     * List recent payments (for admin)
     */
    public function listPayments(Request $req)
    {
        $limit = $req->get('limit', 50);
        $status = $req->get('status');

        $query = Payment::orderBy('created_at', 'desc');

        if ($status) {
            $query->where('status', $status);
        }

        $payments = $query->limit($limit)->get();

        return response()->json([
            'payments' => $payments->map(function ($payment) {
                return [
                    'invoice' => $payment->invoice_number,
                    'name' => $payment->name,
                    'email' => $payment->email,
                    'tour_name' => $payment->tour_name,
                    'total' => $payment->total,
                    'status' => $payment->status,
                    'payment_method' => $payment->payment_method,
                    'paid_at' => $payment->paid_at,
                    'created_at' => $payment->created_at,
                    'last_checked' => $payment->last_status_check
                ];
            }),
            'count' => $payments->count(),
            'pending_count' => Payment::where('status', 'PENDING')->count(),
            'paid_count' => Payment::where('status', 'PAID')->count()
        ]);
    }

    /**
     * Send payment email
     */
    private function sendPaymentEmail($payment)
    {
        try {
            Mail::to($payment->email)->send(new PaymentStatusMail($payment));

            Log::channel('doku')->info('PAYMENT EMAIL SENT', [
                'invoice' => $payment->invoice_number,
                'email' => $payment->email,
                'status' => $payment->status
            ]);

            return true;
        } catch (\Exception $e) {
            Log::channel('doku')->error('FAILED TO SEND PAYMENT EMAIL', [
                'invoice' => $payment->invoice_number,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    public function testSimulatePaid(Request $req)
    {
        $invoice = $req->get('invoice', 'INV-TEST-' . time());

        // Check if payment exists
        $payment = Payment::where('invoice_number', $invoice)->first();

        if (!$payment) {
            // Create test payment
            $payment = Payment::create([
                'invoice_number' => $invoice,
                'name' => 'Test Customer',
                'email' => 'test@example.com',
                'phone' => '081234567890',
                'tour_name' => 'Test Tour',
                'total' => 100000,
                'status' => 'PENDING'
            ]);
        }

        // Update to PAID
        $payment->update([
            'status' => 'PAID',
            'paid_at' => now(),
            'payment_method' => 'CREDIT_CARD',
            'authorization_code' => 'TEST' . time(),
            'raw_response' => json_encode([
                'test' => true,
                'simulated' => true,
                'status' => 'SUCCESS'
            ])
        ]);

        // Send email
        $this->sendPaymentEmail($payment);

        return response()->json([
            'success' => true,
            'message' => 'Payment simulated as PAID',
            'invoice' => $invoice,
            'status' => 'PAID',
            'paid_at' => $payment->paid_at
        ]);
    }

    /**
     * Clean up expired payments
     */
    public function cleanupExpiredPayments()
    {
        $expiredPayments = Payment::where('status', 'PENDING')
            ->where('created_at', '<', now()->subHours(2))
            ->get();

        $marked = 0;

        foreach ($expiredPayments as $payment) {
            // Check one last time
            $dokuStatus = $this->checkDokuStatus($payment->invoice_number);

            if ($dokuStatus && isset($dokuStatus['transaction']['status'])) {
                $status = strtoupper($dokuStatus['transaction']['status']);
                if (!in_array($status, ['SUCCESS', 'COMPLETED', 'PAID'])) {
                    $payment->update(['status' => 'EXPIRED']);
                    $marked++;
                }
            } else {
                $payment->update(['status' => 'EXPIRED']);
                $marked++;
            }
        }

        Log::channel('doku')->info('EXPIRED PAYMENTS CLEANUP', [
            'marked_expired' => $marked,
            'total_checked' => $expiredPayments->count()
        ]);

        return response()->json([
            'marked_expired' => $marked,
            'total_checked' => $expiredPayments->count()
        ]);
    }
}
