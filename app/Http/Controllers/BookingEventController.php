<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BossBookEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Partnership;

class BookingEventController extends Controller
{
    public function index(Request $request)
    {
        $packages = [
            'basic' => [
                'name' => 'Runner Basic Stay',
                'price' => 1800000,
                'features' => [
                    'Airport Shuttle',
                    'Welcome Kit',
                    'Hotel (3 nights)',
                    '1 Pre Race Dinner'
                ],
                'description' => 'For independent runners who only need a solid base',
                'best_for' => 'Experienced runners · Running communities · Those with their own transport plan'
            ],
            'comfort' => [
                'name' => 'Runner Comfort Logistics',
                'price' => 2050000,
                'features' => [
                    'Airport Shuttle',
                    'Welcome Kit',
                    'Transport Drop Point (Motorbike)',
                    'Hotel',
                    '1 Pre Race Dinner'
                ],
                'description' => 'For first-timers & out-of-town runners',
                'best_for' => 'First-time marathoners · Runners new to the city · Stress-free planners'
            ],
            'premium' => [
                'name' => 'Runner Premium Assist',
                'price' => 4150000,
                'features' => [
                    'All Runner Comfort Logistics',
                    'Priority coordination & faster response window',
                    'Dedicated staff contact',
                    'Personalized departure timing plan'
                ],
                'description' => 'For runners who need higher coordination certainty',
                'best_for' => 'Elite athletes · VIP runners · Public figures · Time-sensitive schedules'
            ]
        ];

        $selectedPackage = $request->query('package', 'comfort');
        $event = $request->query('event', 'jakarta');
        $participants = $request->query('participants', 1);

        if (!array_key_exists($selectedPackage, $packages)) {
            $selectedPackage = 'comfort';
        }

        return view('bookingevent', compact('packages', 'selectedPackage', 'event', 'participants'));
    }

    // public function store(Request $request)
    // {
    //     try {
    //         Log::info('Booking form submission received', [
    //             'all_data' => $request->all(),
    //             'package_price' => $request->input('package_price'),
    //             'twin_price' => $request->input('twin_price'),
    //             'single_price' => $request->input('single_price'),
    //             'room_type' => $request->input('room_type'),
    //             'addons_total' => $request->input('addons_total'),
    //             'total_price' => $request->input('total_price')
    //         ]);

    //         $roomType = $request->input('room_type');
    //         if ($roomType === 'twin') {
    //             $request->merge(['room_type' => 'sharing']);
    //         }

    //         $validated = $request->validate([
    //             'event_name' => 'required|string|max:255',
    //             'runner_name' => 'required|string|max:255',
    //             'whatsapp_number' => 'required|string|max:20',
    //             'email' => 'required|email|max:255',
    //             'origin_city' => 'nullable|string|max:100',
    //             'referral_code' => 'nullable|string|max:20',
    //             'hotel_star' => 'required|integer|in:3,4',
    //             'night_count' => 'required|integer|in:1,2,3',
    //             'package_type' => 'required|string',
    //             'package_name' => 'required|string|max:255',
    //             'package_price' => 'required|numeric',
    //             'twin_price' => 'required|numeric',
    //             'single_price' => 'required|numeric',
    //             'checkin_date' => 'required|date',
    //             'checkout_date' => 'required|date|after:checkin_date',
    //             'room_type' => 'required|string|in:sharing,single',
    //             'flight_booking' => 'sometimes|boolean',
    //             'hydration_pack' => 'sometimes|boolean',
    //             'late_checkout' => 'sometimes|boolean',
    //             'early_checkin' => 'sometimes|boolean',
    //             'extra_notes' => 'nullable|string|max:500',
    //             'addons_total' => 'required|numeric',
    //             'total_price' => 'required|numeric'
    //         ]);

    //         Log::info('Validation passed', [
    //             'validated_data' => $validated,
    //             'package_price' => $validated['package_price'],
    //             'twin_price' => $validated['twin_price'],
    //             'single_price' => $validated['single_price']
    //         ]);

    //         $bookingId = 'BOOK-' . strtoupper(Str::random(6)) . '-' . Carbon::now()->format('Ymd');

    //         $addonsTotal = $validated['addons_total'] ?? 0;
    //         if (!$addonsTotal) {
    //             if ($request->has('hydration_pack') && $request->hydration_pack) {
    //                 $addonsTotal += 250000;
    //             }
    //             if ($request->has('late_checkout') && $request->late_checkout) {
    //                 $addonsTotal += 300000;
    //             }
    //             if ($request->has('early_checkin') && $request->early_checkin) {
    //                 $addonsTotal += 300000;
    //             }
    //         }

    //         $checkin = Carbon::parse($validated['checkin_date']);
    //         $checkout = Carbon::parse($validated['checkout_date']);
    //         $nightCount = $checkin->diffInDays($checkout);

    //         $booking = BossBookEvent::create([
    //             'booking_id' => $bookingId,
    //             'event_name' => $validated['event_name'],
    //             'runner_name' => $validated['runner_name'],
    //             'whatsapp_number' => $validated['whatsapp_number'],
    //             'email' => $validated['email'],
    //             'origin_city' => $validated['origin_city'] ?? null,
    //             'referral_code' => $validated['referral_code'] ?? null,
    //             'hotel_star' => $validated['hotel_star'],
    //             'night_count' => $validated['night_count'] ?? $nightCount,
    //             'package_type' => $validated['package_type'],
    //             'package_name' => $validated['package_name'],
    //             'package_price' => $validated['package_price'],
    //             'twin_price' => $validated['twin_price'] ?? 0,
    //             'single_price' => $validated['single_price'] ?? 0,
    //             'checkin_date' => $validated['checkin_date'],
    //             'checkout_date' => $validated['checkout_date'],
    //             'room_type' => $validated['room_type'],
    //             'flight_booking' => $request->boolean('flight_booking', false),
    //             'hydration_pack' => $request->boolean('hydration_pack', false),
    //             'hydration_pack_price' => $request->boolean('hydration_pack', false) ? 250000 : 0,
    //             'late_checkout' => $request->boolean('late_checkout', false),
    //             'early_checkin' => $request->boolean('early_checkin', false),
    //             'extra_notes' => $validated['extra_notes'] ?? null,
    //             'addons_total' => $addonsTotal,
    //             'total_price' => $validated['total_price'],
    //             'payment_status' => 'pending'
    //         ]);

    //         Log::info('Booking created', [
    //             'booking_id' => $booking->id,
    //             'booking_code' => $booking->booking_id,
    //             'package_price_saved' => $booking->package_price,
    //             'twin_price_saved' => $booking->twin_price,
    //             'single_price_saved' => $booking->single_price,
    //             'room_type_saved' => $booking->room_type,
    //             'total_price_saved' => $booking->total_price
    //         ]);

    //         $dokuResponse = $this->createDokuPayment($booking);

    //         if ($dokuResponse['success']) {
    //             $booking->update([
    //                 'doku_invoice_number' => $dokuResponse['invoice_number'],
    //                 'doku_url' => $dokuResponse['payment_url']
    //             ]);

    //             return response()->json([
    //                 'success' => true,
    //                 'booking_id' => $bookingId,
    //                 'payment_url' => $dokuResponse['payment_url'],
    //                 'invoice_number' => $dokuResponse['invoice_number']
    //             ]);
    //         } else {
    //             Log::error('Doku payment failed', [
    //                 'error' => $dokuResponse['error'],
    //                 'booking_id' => $booking->id
    //             ]);

    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Failed to create payment',
    //                 'error' => $dokuResponse['error']
    //             ], 500);
    //         }
    //     } catch (\Exception $e) {
    //         Log::error('Booking error: ' . $e->getMessage(), [
    //             'trace' => $e->getTraceAsString(),
    //             'request_data' => $request->all()
    //         ]);

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Booking failed. Please try again.',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function store(Request $request)
    {
        try {
            $roomType = $request->input('room_type');
            if ($roomType === 'twin') {
                $request->merge(['room_type' => 'sharing']);
            }

            $validated = $request->validate([
                'event_name'     => 'required|string|max:255',
                'runner_name'    => 'required|string|max:255',
                'whatsapp_number' => 'required|string|max:20',
                'email'          => 'required|email|max:255',
                'origin_city'    => 'nullable|string|max:100',
                'referral_code'  => 'nullable|string|max:20',
                'hotel_star'     => 'required|integer|in:3,4',
                'night_count'    => 'required|integer|in:1,2,3',
                'package_type'   => 'required|string',
                'package_name'   => 'required|string|max:255',
                'package_price'  => 'required|numeric',
                'twin_price'     => 'required|numeric',
                'single_price'   => 'required|numeric',
                'checkin_date'   => 'required|date',
                'checkout_date'  => 'required|date|after:checkin_date',
                'room_type'      => 'required|string|in:sharing,single',
                'flight_booking' => 'sometimes|boolean',
                'hydration_pack' => 'sometimes|boolean',
                'late_checkout'  => 'sometimes|boolean',
                'early_checkin'  => 'sometimes|boolean',
                'extra_notes'    => 'nullable|string|max:500',
                'addons_total'   => 'required|numeric',
                'total_price'    => 'required|numeric',
                'pax_count'      => 'sometimes|integer|min:1',
            ]);

            $referralCode = $validated['referral_code'] ?? null;
            $referralDiscount = 0;
            $partnership = null;

            if ($referralCode) {
                $partnership = Partnership::where('referral_code', strtoupper($referralCode))
                    ->where('status', 'approved')
                    ->first();

                if ($partnership) {
                    $referralDiscount = 150000;
                }
            }

            $bookingId = 'BOOK-' . strtoupper(Str::random(6)) . '-' . Carbon::now()->format('Ymd');

            $paxCount = $validated['pax_count'] ?? 1;
            $totalDiscount = $referralDiscount * $paxCount;
            $finalTotal = $validated['total_price'] - $totalDiscount;

            $booking = BossBookEvent::create([
                'booking_id'       => $bookingId,
                'event_name'       => $validated['event_name'],
                'runner_name'      => $validated['runner_name'],
                'whatsapp_number'  => $validated['whatsapp_number'],
                'email'            => $validated['email'],
                'origin_city'      => $validated['origin_city'] ?? null,
                'referral_code'     => $referralCode,
                'referral_discount' => $totalDiscount,
                'hotel_star'       => $validated['hotel_star'],
                'night_count'      => $validated['night_count'],
                'package_type'     => $validated['package_type'],
                'package_name'     => $validated['package_name'],
                'package_price'    => $validated['package_price'],
                'twin_price'       => $validated['twin_price'],
                'single_price'     => $validated['single_price'],
                'checkin_date'     => $validated['checkin_date'],
                'checkout_date'    => $validated['checkout_date'],
                'room_type'        => $validated['room_type'],
                'flight_booking'   => $request->boolean('flight_booking', false),
                'hydration_pack'   => $request->boolean('hydration_pack', false),
                'hydration_pack_price' => $request->boolean('hydration_pack', false) ? 250000 : 0,
                'late_checkout'    => $request->boolean('late_checkout', false),
                'early_checkin'    => $request->boolean('early_checkin', false),
                'extra_notes'      => $validated['extra_notes'] ?? null,
                'addons_total'     => $validated['addons_total'],
                'total_price'      => $validated['total_price'],
                'payment_status'   => 'pending',
            ]);

            // Build pesan WhatsApp
            $waMessage = $this->buildWhatsAppMessage($booking, $request->input('pax_count', 1));
            $waNumber  = env('WA_ADMIN_NUMBER', '6285727767777'); // simpan di .env
            $waUrl     = 'https://wa.me/' . $waNumber . '?text=' . rawurlencode($waMessage);

            return response()->json([
                'success'    => true,
                'booking_id' => $bookingId,
                'wa_url'     => $waUrl,
            ]);
        } catch (\Exception $e) {
            Log::error('Booking error: ' . $e->getMessage(), [
                'trace'        => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Booking failed. Please try again.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    // ── Helper: bangun teks pesan WA ──────────────────────────────────────────────
    private function buildWhatsAppMessage(BossBookEvent $booking, int $pax = 1): string
    {
        $roomDisplay   = $booking->room_type === 'sharing' ? 'Twin Room (Sharing)' : 'Single Room (Private)';
        $checkin       = Carbon::parse($booking->checkin_date)->format('d M Y');
        $checkout      = Carbon::parse($booking->checkout_date)->format('d M Y');
        $nightText     = $booking->night_count . ' Night' . ($booking->night_count > 1 ? 's' : '');
        $totalFormatted = 'IDR ' . number_format($booking->total_price, 0, ',', '.');

        $addons = [];
        if ($booking->flight_booking)  $addons[] = '✈️ Flight Booking Assistance';
        if ($booking->hydration_pack)  $addons[] = '💧 Premium Hydration Pack (+IDR 250.000)';
        if ($booking->late_checkout)   $addons[] = '🕐 Late Check-out (+IDR 300.000)';
        if ($booking->early_checkin)   $addons[] = '🌅 Early Check-in (+IDR 300.000)';
        $addonsText = count($addons) ? implode("\n   ", $addons) : '-';

        $discountLine = $booking->referral_discount > 0
            ? "\n*Diskon Referral:* -IDR " . number_format($booking->referral_discount, 0, ',', '.')
            : null;

        $lines = [
            '🏃 *MARATHON BOOKING REQUEST*',
            '━━━━━━━━━━━━━━━━━━━━━━',
            '',
            '*Booking ID:* ' . $booking->booking_id,
            '*Event:* ' . $booking->event_name,
            '',
            '*Runner Information*',
            '   Nama     : ' . $booking->runner_name,
            '   WhatsApp : +62' . $booking->whatsapp_number,
            '   Email    : ' . $booking->email,
            $booking->origin_city ? '   Kota    : ' . $booking->origin_city : null,
            $booking->referral_code ? '   Referral: ' . $booking->referral_code : null,
            '',
            '*Stay & Package*',
            '   Paket    : ' . $booking->package_name,
            '   Hotel    : ' . $booking->hotel_star . ' Star Hotel',
            '   Durasi   : ' . $nightText,
            '   Kamar    : ' . $roomDisplay,
            '   Check-in : ' . $checkin,
            '   Check-out: ' . $checkout,
            '   Peserta  : ' . $pax . ' orang',
            '',
            '*Add-ons*',
            '   ' . $addonsText,
            '',
            $discountLine,
            '*Total: ' . $totalFormatted . '*',
            '',
            $booking->extra_notes ? '*Catatan:* ' . $booking->extra_notes : null,
            '━━━━━━━━━━━━━━━━━━━━━━',
            'Mohon konfirmasi ketersediaan. Terima kasih!',
        ];

        // Filter baris null lalu gabungkan
        return implode("\n", array_filter($lines, fn($l) => $l !== null));
    }

    private function createDokuPayment(BossBookEvent $booking)
    {
        try {
            $clientId = env('DOKU_CLIENT_ID');
            $secretKey = env('DOKU_SECRET_KEY');
            $baseUrl = env('DOKU_BASE_URL', 'https://api-sandbox.doku.com');

            if (empty($clientId) || empty($secretKey)) {
                throw new \Exception('Doku credentials not configured');
            }

            $invoiceNumber = 'INV-' . $booking->booking_id . '-' . time();
            $phoneNumber = $this->formatPhoneNumber($booking->whatsapp_number);

            $roomTypeDisplay = $booking->room_type === 'sharing' ? 'Twin Sharing' : 'Single Private';

            Log::info('=== DOKU PAYMENT DEBUG ===', [
                'booking_id' => $booking->booking_id,
                'room_type' => $booking->room_type,
                'twin_price' => $booking->twin_price,
                'single_price' => $booking->single_price,
                'package_price' => $booking->package_price,
                'addons_total' => $booking->addons_total,
                'total_price' => $booking->total_price
            ]);

            $packagePrice = 0;

            if ($booking->room_type === 'sharing') {
                $packagePrice = (int) $booking->twin_price;
                Log::info('Using twin price for sharing room', [
                    'price' => $packagePrice,
                    'source' => 'twin_price'
                ]);
            } else {
                $packagePrice = (int) $booking->single_price;
                Log::info('Using single price for single room', [
                    'price' => $packagePrice,
                    'source' => 'single_price'
                ]);
            }

            if ($packagePrice <= 0 && $booking->package_price > 0) {
                $packagePrice = (int) $booking->package_price;
                Log::warning('Falling back to package_price', [
                    'price' => $packagePrice,
                    'original_room_type' => $booking->room_type
                ]);
            }

            if ($packagePrice <= 0) {
                Log::error('Package price is zero or negative', [
                    'package_price' => $packagePrice,
                    'twin_price' => $booking->twin_price,
                    'single_price' => $booking->single_price,
                    'booking_id' => $booking->booking_id
                ]);
                throw new \Exception('Invalid package price: ' . $packagePrice);
            }

            $lineItems = [];
            $nightText = $booking->night_count . ' night' . ($booking->night_count > 1 ? 's' : '');

            $lineItems[] = [
                'name' => $booking->package_name . ' - ' . $roomTypeDisplay . ' - ' . $nightText,
                'price' => $packagePrice,
                'quantity' => 1,
                'category' => 'Hotel Package'
            ];

            if ($booking->hydration_pack) {
                $lineItems[] = [
                    'name' => 'Premium Hydration Pack',
                    'price' => 250000,
                    'quantity' => 1,
                    'category' => 'Add-on'
                ];
            }

            if ($booking->late_checkout) {
                $lineItems[] = [
                    'name' => 'Late Check-out',
                    'price' => 300000,
                    'quantity' => 1,
                    'category' => 'Add-on'
                ];
            }

            if ($booking->early_checkin) {
                $lineItems[] = [
                    'name' => 'Early Check-in',
                    'price' => 300000,
                    'quantity' => 1,
                    'category' => 'Add-on'
                ];
            }

            $amount = array_sum(array_column($lineItems, 'price'));

            $paymentData = [
                'order' => [
                    'amount' => $amount,
                    'invoice_number' => $invoiceNumber,
                    'currency' => 'IDR',
                    'line_items' => $lineItems,
                ],
                'payment' => [
                    'payment_due_date' => 60,
                    'allowed_payment_methods' => [
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
                'credit_card' => [
                    'is_3ds' => true,
                ],
                'customer' => [
                    'name' => substr($this->sanitizeDokuString($booking->runner_name), 0, 50),
                    'email' => $this->sanitizeDokuString($booking->email),
                    'phone' => $phoneNumber,
                    'country' => 'ID',
                ],
                'additional_info' => [
                    'allow_tenor' => [0, 3, 6, 12],
                    'close_redirect' => route('payment.return', ['invoice' => $invoiceNumber], true),
                ],
                'return_url' => route('payment.return', ['invoice' => $invoiceNumber], true),
                'notify_url' => route('payment.notify', [], true)
            ];

            Log::info('Final payment data to Doku', [
                'invoice' => $invoiceNumber,
                'amount' => $amount,
                'package_price_included' => $packagePrice,
                'total_line_items' => $amount
            ]);

            $response = $this->callDoku($paymentData);

            if (!isset($response['response']['payment']['url'])) {
                Log::error('DOKU PAYMENT FAILED', $response);
                return [
                    'success' => false,
                    'error' => 'Failed to create payment',
                    'invoice_number' => $invoiceNumber
                ];
            }

            Log::info('Doku payment success', [
                'invoice' => $invoiceNumber,
                'payment_url' => $response['response']['payment']['url']
            ]);

            return [
                'success' => true,
                'invoice_number' => $invoiceNumber,
                'payment_url' => $response['response']['payment']['url'],
                'transaction_id' => $response['transaction']['id'] ?? null,
                'response' => $response
            ];
        } catch (\Exception $e) {
            Log::error('Doku payment exception: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'booking_id' => $booking->booking_id ?? 'unknown'
            ]);
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    private function callDoku($payload)
    {
        $clientId = env('DOKU_CLIENT_ID');
        $secret = env('DOKU_SECRET_KEY');
        $baseUrl = env('DOKU_BASE_URL', 'https://api-sandbox.doku.com');
        $url = $baseUrl . "/checkout/v1/payment";

        $body = json_encode($payload, JSON_UNESCAPED_SLASHES);
        $timestamp = gmdate("Y-m-d\TH:i:s\Z");
        $requestId = (string) time();

        $signature = $this->makeSignatureForRequest($body, $secret, $clientId, $requestId, $timestamp);

        try {
            $response = Http::timeout(30)
                ->withHeaders([
                    'Client-Id'         => $clientId,
                    'Request-Id'        => $requestId,
                    'Request-Timestamp' => $timestamp,
                    'Signature'         => $signature,
                ])
                ->withBody($body, 'application/json')
                ->post($url);

            Log::info('Doku API response', [
                'status' => $response->status(),
                'body'   => $response->json()
            ]);

            if ($response->failed()) {
                return ['error' => 'Doku API error', 'status_code' => $response->status(), 'response' => $response->json()];
            }

            return $response->json();
        } catch (\Exception $e) {
            Log::error('Doku API exception: ' . $e->getMessage());
            return ['error' => $e->getMessage()];
        }
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

    public function handleReturn(Request $request)
    {
        $invoice = $request->get('invoice');

        Log::channel('doku')->info('PAYMENT RETURN HANDLER', [
            'invoice' => $invoice,
            'all_params' => $request->all(),
            'ip' => $request->ip()
        ]);

        if (!$invoice) {
            Log::channel('doku')->error('NO INVOICE IN RETURN URL');
            return redirect('/')->with('error', 'Invoice not found in return URL');
        }

        $booking = BossBookEvent::where('doku_invoice_number', $invoice)->first();

        if (!$booking) {
            Log::channel('doku')->error('BOOKING NOT FOUND IN DATABASE', ['invoice' => $invoice]);
            return redirect('/')->with('error', 'Booking record not found');
        }

        $dokuStatus = $this->checkDokuStatus($invoice);

        if ($dokuStatus) {
            $this->updateBookingFromDokuStatus($booking, $dokuStatus);
            $booking->refresh();
        }

        Log::channel('doku')->info('RETURN HANDLER COMPLETED', [
            'invoice' => $invoice,
            'status' => $booking->payment_status,
            'booking_id' => $booking->booking_id
        ]);

        return redirect()->route('booking.success', ['id' => $booking->booking_id])
            ->with('success', 'Payment ' . $booking->payment_status);
    }

    private function checkDokuStatus($invoice)
    {
        try {
            $clientId = env('DOKU_CLIENT_ID');
            $secret = env('DOKU_SECRET_KEY');
            $baseUrl = env('DOKU_BASE_URL', 'https://api-sandbox.doku.com');

            $timestamp = gmdate("Y-m-d\TH:i:s\Z");
            $requestId = 'status-' . time();

            // GET request — digest of empty body
            $digest = base64_encode(hash('sha256', '', true));

            $target = "/orders/v1/status/{$invoice}";
            $stringToSign = "Client-Id:{$clientId}\n" .
                "Request-Id:{$requestId}\n" .
                "Request-Timestamp:{$timestamp}\n" .
                "Request-Target:{$target}\n" .
                "Digest:{$digest}";

            $signature = "HMACSHA256=" . base64_encode(
                hash_hmac('sha256', $stringToSign, $secret, true)
            );

            $response = Http::timeout(15)
                ->withHeaders([
                    'Client-Id'         => $clientId,
                    'Request-Id'        => $requestId,
                    'Request-Timestamp' => $timestamp,
                    'Signature'         => $signature,
                ])
                ->get($baseUrl . $target);

            Log::channel('doku')->info('STATUS CHECK', [
                'invoice'   => $invoice,
                'http_code' => $response->status(),
                'response'  => $response->json()
            ]);

            if ($response->failed()) return null;

            return $response->json();
        } catch (\Exception $e) {
            Log::channel('doku')->error('STATUS CHECK FAILED', ['error' => $e->getMessage()]);
            return null;
        }
    }

    private function updateBookingFromDokuStatus($booking, $dokuStatus)
    {
        Log::channel('doku')->info('PROCESSING STATUS UPDATE', [
            'booking_id' => $booking->booking_id,
            'invoice' => $booking->doku_invoice_number,
            'doku_status_data' => $dokuStatus
        ]);

        // Try multiple possible paths for status
        $status = null;

        if (isset($dokuStatus['transaction']['status'])) {
            $status = $dokuStatus['transaction']['status'];
        } elseif (isset($dokuStatus['order']['status'])) {
            $status = $dokuStatus['order']['status'];
        } elseif (isset($dokuStatus['payment']['status'])) {
            $status = $dokuStatus['payment']['status'];
        } elseif (isset($dokuStatus['result']['status'])) {
            $status = $dokuStatus['result']['status'];
        } elseif (isset($dokuStatus['status'])) {
            $status = $dokuStatus['status'];
        } elseif (isset($dokuStatus['order']['invoice_number'])) {
            if (isset($dokuStatus['order']['amount']) && $dokuStatus['order']['amount'] > 0) {
                Log::channel('doku')->info('Assuming success based on amount', [
                    'amount' => $dokuStatus['order']['amount']
                ]);
                $status = 'SUCCESS';
            }
        }

        if (!$status) {
            Log::channel('doku')->warning('NO STATUS FOUND IN RESPONSE', [
                'invoice' => $booking->doku_invoice_number,
                'available_keys' => array_keys($dokuStatus)
            ]);
            return;
        }

        // Get payment method
        $paymentMethod = 'UNKNOWN';
        if (isset($dokuStatus['channel']['id'])) {
            $paymentMethod = $dokuStatus['channel']['id'];
        } elseif (isset($dokuStatus['payment']['method'])) {
            $paymentMethod = $dokuStatus['payment']['method'];
        } elseif (isset($dokuStatus['service']['id'])) {
            $paymentMethod = $dokuStatus['service']['id'];
        }

        // Extended status mapping
        $map = [
            'SUCCESS' => 'paid',
            'SUCCEEDED' => 'paid',
            'COMPLETED' => 'paid',
            'SETTLED' => 'paid',
            'PAID' => 'paid',
            'CAPTURED' => 'paid',
            'AUTHORIZED' => 'pending',
            'CHALLENGE' => 'pending',
            'PENDING' => 'pending',
            'WAITING' => 'pending',
            'PROCESSING' => 'pending',
            'FAILED' => 'failed',
            'DENIED' => 'failed',
            'EXPIRED' => 'failed',
            'REFUNDED' => 'refunded',
            'VOID' => 'failed',
            'CANCELLED' => 'failed'
        ];

        $statusUpper = strtoupper($status);
        $newStatus = $map[$statusUpper] ?? 'pending';

        Log::channel('doku')->info('STATUS MAPPING', [
            'original_status' => $status,
            'status_upper' => $statusUpper,
            'mapped_status' => $newStatus,
            'current_booking_status' => $booking->payment_status
        ]);

        if ($booking->payment_status === $newStatus) {
            Log::channel('doku')->info('STATUS ALREADY UP TO DATE', [
                'booking_id' => $booking->booking_id,
                'status' => $newStatus
            ]);
            return;
        }

        $update = [
            'payment_status' => $newStatus,
            'payment_method' => $paymentMethod,
            'doku_raw_response' => json_encode($dokuStatus),
            'last_status_check' => now(),
        ];

        if (isset($dokuStatus['card_payment'])) {
            $update['authorization_code'] = $dokuStatus['card_payment']['approval_code'] ?? null;
            $update['card_info'] = json_encode([
                'masked' => $dokuStatus['card_payment']['masked_card_number'] ?? null,
                'brand' => $dokuStatus['card_payment']['brand'] ?? null,
                'issuer' => $dokuStatus['card_payment']['issuer'] ?? null,
            ]);
        }

        if ($newStatus === 'paid') {
            $update['paid_at'] = now();
        }

        $booking->update($update);

        Log::channel('doku')->info('BOOKING STATUS UPDATED', [
            'invoice' => $booking->doku_invoice_number,
            'booking_id' => $booking->booking_id,
            'from' => $booking->getOriginal('payment_status'),
            'to' => $newStatus,
            'method' => $paymentMethod
        ]);

        if ($newStatus === 'paid') {
            $this->sendConfirmation($booking);
        }
    }

    public function notify(Request $request)
    {
        $raw = $request->getContent();
        Log::channel('doku')->info('DOKU NOTIFY RAW', [
            'body' => $raw,
            'headers' => $request->headers->all(),
            'method' => $request->method(),
            'ip' => $request->ip()
        ]);

        $data = json_decode($raw, true);
        if (!is_array($data)) {
            Log::channel('doku')->warning('DOKU NOTIFY - Invalid JSON', ['raw' => $raw]);
            return response()->json(['message' => 'OK'], 200);
        }

        Log::channel('doku')->info('DOKU NOTIFY PARSED DATA', $data);

        $invoice = $data['order']['invoice_number']
            ?? $data['invoice_number']
            ?? $data['transaction']['invoice_number']
            ?? null;

        if (!$invoice) {
            Log::channel('doku')->warning('DOKU NOTIFY - NO INVOICE', $data);
            return response()->json(['message' => 'OK'], 200);
        }

        $booking = BossBookEvent::where('doku_invoice_number', $invoice)->first();

        if (!$booking) {
            Log::channel('doku')->warning('DOKU NOTIFY - BOOKING NOT FOUND', ['invoice' => $invoice]);
            return response()->json(['message' => 'OK'], 200);
        }

        Log::channel('doku')->info('DOKU NOTIFY - BOOKING FOUND', [
            'booking_id' => $booking->booking_id,
            'current_status' => $booking->payment_status
        ]);

        $this->updateBookingFromDokuStatus($booking, $data);

        return response()->json(['message' => 'OK'], 200);
    }

    public function checkStatus($bookingId)
    {
        $booking = BossBookEvent::where('booking_id', $bookingId)->first();

        if (!$booking) {
            return response()->json(['error' => 'Booking not found'], 404);
        }

        $dokuStatus = $this->checkDokuStatus($booking->doku_invoice_number);

        // Tambah ini untuk lihat raw response dari Doku
        return response()->json([
            'booking_id' => $booking->booking_id,
            'invoice' => $booking->doku_invoice_number,
            'status' => $booking->payment_status,
            'doku_raw_response' => $dokuStatus, // ← tambah ini
            'payment_method' => $booking->payment_method,
            'paid_at' => $booking->paid_at,
            'last_checked' => $booking->last_status_check
        ]);
    }

    public function checkPendingPayments()
    {
        Log::channel('doku')->info('STARTING SCHEDULED CHECK');

        $pendingBookings = BossBookEvent::where('payment_status', 'pending')
            ->where('created_at', '>', now()->subHours(24))
            ->whereNotNull('doku_invoice_number')
            ->get();

        $checked = 0;
        $updated = 0;

        foreach ($pendingBookings as $booking) {
            $checked++;

            if (
                $booking->last_status_check &&
                Carbon::parse($booking->last_status_check)->diffInMinutes(now()) < 5
            ) {
                continue;
            }

            Log::channel('doku')->info('Checking pending payment', [
                'booking_id' => $booking->booking_id,
                'invoice' => $booking->doku_invoice_number,
                'created_at' => $booking->created_at
            ]);

            $dokuStatus = $this->checkDokuStatus($booking->doku_invoice_number);

            if ($dokuStatus) {
                $oldStatus = $booking->payment_status;
                $this->updateBookingFromDokuStatus($booking, $dokuStatus);
                $booking->refresh();

                if ($booking->payment_status !== $oldStatus) {
                    $updated++;
                    Log::channel('doku')->info('Payment status changed', [
                        'booking_id' => $booking->booking_id,
                        'from' => $oldStatus,
                        'to' => $booking->payment_status
                    ]);
                }
            }

            if ($checked < count($pendingBookings)) {
                sleep(1);
            }
        }

        Log::channel('doku')->info('SCHEDULED CHECK COMPLETED', [
            'checked' => $checked,
            'updated' => $updated,
            'total_pending' => $pendingBookings->count()
        ]);

        return response()->json([
            'checked' => $checked,
            'updated' => $updated,
            'total' => $pendingBookings->count(),
            'timestamp' => now()->toDateTimeString()
        ]);
    }

    private function sanitizeDokuString($string)
    {
        if (empty($string)) {
            return 'Guest';
        }

        $string = trim((string) $string);

        $replacements = [
            "\xE2\x80\x9C" => "'",
            "\xE2\x80\x9D" => "'",
            "\xE2\x80\x98" => "'",
            "\xE2\x80\x99" => "'",
            '`' => "'",
            "\xC2\xB4" => "'",
            "\xE2\x80\x94" => '-',
            "\xE2\x80\x93" => '-',
            "\xE2\x88\x92" => '-',
            "\xE2\x80\xA2" => '-',
            "\xC2\xB7" => '-',
            "\xE2\x80\xA6" => '...',
            '(' => '',
            ')' => '',
            '[' => '',
            ']' => '',
            '{' => '',
            '}' => '',
            '<' => '',
            '>' => '',
            '&' => 'and',
            '#' => 'No',
            '$' => '',
            '*' => '',
            '~' => '-',
            '^' => '',
            '|' => '-',
            '\\' => '/',
            "\xC2\xA0" => ' ',
            "\t" => ' ',
            "\n" => ' ',
            "\r" => ' ',
        ];

        $string = str_replace(array_keys($replacements), array_values($replacements), $string);
        $string = preg_replace('/[^a-zA-Z0-9\s\.\-\/\+,_=:\'@%]/', '', $string);
        $string = preg_replace('/\s+/', ' ', $string);
        $string = trim($string);
        $string = preg_replace('/\.{2,}/', '.', $string);
        $string = preg_replace('/\-{2,}/', '-', $string);

        if (empty($string)) {
            return 'Guest';
        }

        return substr($string, 0, 200);
    }

    private function formatPhoneNumber($number)
    {
        $number = preg_replace('/[^0-9]/', '', $number);

        if (substr($number, 0, 1) === '0') {
            $number = '62' . substr($number, 1);
        }

        if (substr($number, 0, 2) !== '62') {
            $number = '62' . $number;
        }

        return $number;
    }

    public function bookingSuccess($id)
    {
        $booking = BossBookEvent::where('booking_id', $id)->firstOrFail();

        if ($booking->payment_status === 'pending' && $booking->doku_invoice_number) {
            $dokuStatus = $this->checkDokuStatus($booking->doku_invoice_number);
            if ($dokuStatus) {
                $this->updateBookingFromDokuStatus($booking, $dokuStatus);
                $booking->refresh();
            }
        }

        return view('booking.success', compact('booking'));
    }

    private function sendToBackoffice(BossBookEvent $booking): void
    {
        try {
            $backoffice = new \App\Services\BackofficeService();
            $eventCodes = $this->getEventCodes($booking->event_name);

            $roomDisplay  = $booking->room_type === 'sharing' ? 'Twin Sharing' : 'Single Private';
            $nightText    = $booking->night_count . ' malam';
            $checkin      = \Carbon\Carbon::parse($booking->checkin_date)->format('d M Y');
            $checkout     = \Carbon\Carbon::parse($booking->checkout_date)->format('d M Y');

            $note = implode(' | ', array_filter([
                'Runner: '   . $booking->runner_name,
                'WA: '       . $booking->whatsapp_number,
                'Email: '    . $booking->email,
                'Kamar: '    . $roomDisplay,
                'Checkin: '  . $checkin,
                'Checkout: ' . $checkout,
                $booking->origin_city  ? 'Kota Asal: ' . $booking->origin_city  : null,
                $booking->extra_notes  ? 'Catatan: '   . $booking->extra_notes  : null,
                'Booking ID: ' . $booking->booking_id,
            ]));

            $packageName = implode(' - ', array_filter([
                $booking->package_name,
                ucfirst($booking->event_name) . ' Marathon',
                $roomDisplay,
                $nightText,
            ]));

            $result = $backoffice->sendPackage([
                'package_name'  => $packageName,
                'pax'           => 1,
                'package_code2' => $eventCodes['PackageCode2'],
                'tour_code'     => $eventCodes['TourCode'],
                'note'          => $note,
                'code_dest'     => 'ID',
            ]);

            Log::info('Backoffice sync result', [
                'booking_id' => $booking->booking_id,
                'success'    => $result['success'],
                'http_code'  => $result['http_code'] ?? null,
            ]);
        } catch (\Exception $e) {
            Log::error('sendToBackoffice exception: ' . $e->getMessage(), [
                'booking_id' => $booking->booking_id,
            ]);
        }
    }

    private function getEventCodes(string $eventName): array
    {
        $map = [
            'jakarta' => ['PackageCode2' => '06A1', 'TourCode' => '06A1D154'],
        ];

        return $map[strtolower($eventName)] ?? ['PackageCode2' => '', 'TourCode' => ''];
    }

    private function sendConfirmation(BossBookEvent $booking)
    {
        try {
            Log::info('Payment confirmation would be sent', [
                'booking_id'  => $booking->booking_id,
                'runner_name' => $booking->runner_name,
                'email'       => $booking->email,
                'whatsapp'    => $booking->whatsapp_number,
                'total'       => $booking->total_price,
                'status'      => $booking->payment_status
            ]);

            $this->sendToBackoffice($booking);
        } catch (\Exception $e) {
            Log::error('Failed to send confirmation: ' . $e->getMessage());
        }
    }
}
