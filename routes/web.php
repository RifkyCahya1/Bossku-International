<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\AttractionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\FormEventController;
use App\Http\Controllers\PartnershipController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminToursController;
use App\Http\Controllers\AdminLeadsController;
use App\Http\Controllers\AdminBookingsController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\BookingEventController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItineraryBuilderController;
use App\Http\Controllers\ProfileController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('Explore', [HomeController::class, 'explore']);
Route::get('Province/{province}', [ProvinceController::class, 'show'])->name('province.show');
Route::get('About', [HomeController::class, 'about'])->name('about');
Route::get('Tour', [ItineraryBuilderController::class, 'user_index']);
Route::get('FAQ', [HomeController::class, 'faq']);
Route::get('terms', [HomeController::class, 'terms']);
Route::get('privacy', [HomeController::class, 'privacy']);
Route::get('Custom-Form', [HomeController::class, 'customForm']);
Route::get('/tour/detail/{kode}', [TourController::class, 'details']);
Route::get('Destination', [HomeController::class, 'destination'])->name('destination');
Route::get('Experience', [AttractionController::class, 'experience'])->name('experience');
Route::get('/attraction/{id}', [AttractionController::class, 'show'])->name('show');
Route::get('Booking', [HomeController::class, 'booking'])->name('booking-form');
Route::get('Profile', [HomeController::class, 'profil']);
Route::get('Dashboard', [HomeController::class, 'client']);
Route::post('/send-inquiry', [TourController::class, 'send']);
Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');
Route::get('/partnership', [PartnershipController::class, 'partner'])->name('partnership');
Route::post('/partnership', [PartnershipController::class, 'store'])->name('partnership.store');
Route::post('/payment/doku/create', [PaymentController::class, 'createDoku']);

Route::post('/payment/doku/notify', [PaymentController::class, 'notify']);
Route::post('/payment/doku/callback', [PaymentController::class, 'callback']);
Route::post('/payment/doku/credit-card-webhook', [PaymentController::class, 'creditCardWebhook']);
Route::get('/payment/return', [PaymentController::class, 'returnHandler']);
Route::get('/payment/status/{invoice}', [PaymentController::class, 'checkStatus']);
Route::get('/payment/processing/{invoice}', [PaymentController::class, 'processing']);
Route::post('/payment/create-doku', [PaymentController::class, 'createDoku']);
Route::get('/payment/simulate-notify', [PaymentController::class, 'simulateNotification']);
Route::get('/sitemap.xml', [SitemapController::class, 'index']);

Route::get('/booking', [BookingEventController::class, 'index'])->name('booking.index');
Route::post('/booking/submit', [BookingEventController::class, 'store'])->name('booking.store');
Route::get('/booking/success/{id}', [BookingEventController::class, 'bookingSuccess'])->name('booking.success');
Route::get('/booking/status/{bookingId}', [BookingEventController::class, 'checkStatus'])->name('booking.status');

Route::get('/api/referral/validate', function (Request $request) {
    $code = strtoupper($request->query('code', ''));

    if (!$code) {
        return response()->json(['valid' => false]);
    }

    $exists = \App\Models\Partnership::where('referral_code', $code)
        ->where('status', 'approved')
        ->exists();

    return response()->json([
        'valid'            => $exists,
        'discount_per_pax' => $exists ? 150000 : 0,
    ]);
});

if (app()->environment('local')) {
    Route::get('/test/backoffice/{bookingId}', function ($bookingId) {
        $booking = \App\Models\BossBookEvent::where('booking_id', $bookingId)->firstOrFail();

        $controller = new \App\Http\Controllers\BookingEventController();

        $method = new \ReflectionMethod($controller, 'sendToBackoffice');
        $method->setAccessible(true);
        $method->invoke($controller, $booking);

        return response()->json([
            'message'    => 'Test backoffice sync triggered',
            'booking_id' => $booking->booking_id,
            'check_log'  => 'Lihat storage/logs/laravel.log',
        ]);
    });
}

Route::get('/debug/booking-status/{bookingId}', function ($bookingId) {
    $booking = \App\Models\BossBookEvent::where('booking_id', $bookingId)->first();
    $controller = new \App\Http\Controllers\BookingEventController();
    $method = new \ReflectionMethod($controller, 'checkDokuStatus');
    $method->setAccessible(true);
    $result = $method->invoke($controller, $booking->doku_invoice_number);
    return response()->json([
        'booking' => $booking,
        'doku_raw' => $result
    ]);
});

Route::any('/debug/doku-test', function (Request $request) {
    $raw = $request->getContent();
    $headers = $request->headers->all();
    $method = $request->method();
    $url = $request->fullUrl();

    Log::channel('doku')->info('===== DOKU TEST ENDPOINT HIT =====', [
        'method' => $method,
        'url' => $url,
        'headers' => $headers,
        'raw_content' => $raw,
        'parsed' => json_decode($raw, true),
        'ip' => $request->ip()
    ]);

    return response()->json([
        'message' => 'Debug endpoint hit',
        'method' => $method,
        'headers_received' => array_keys($headers),
        'data_received' => json_decode($raw, true) ?: $raw
    ]);
})->withoutMiddleware([VerifyCsrfToken::class]);

Route::get('/form-event', [FormEventController::class, 'showForm'])->name('form.event');

Route::any('/payment/doku/debug', function (Request $req) {
    $logFile = storage_path('logs/doku_debug_raw.txt');
    $logContent = "[" . date('Y-m-d H:i:s') . "]\n";
    $logContent .= "Method: " . $req->method() . "\n";
    $logContent .= "URL: " . $req->fullUrl() . "\n";
    $logContent .= "IP: " . $req->ip() . "\n";
    $logContent .= "Headers:\n";
    foreach ($req->headers->all() as $key => $values) {
        $logContent .= "  {$key}: " . implode(', ', $values) . "\n";
    }
    $logContent .= "Body: " . $req->getContent() . "\n";
    $logContent .= "=================================\n\n";

    file_put_contents($logFile, $logContent, FILE_APPEND);

    return response()->json([
        'status' => 'ok',
        'time' => date('Y-m-d H:i:s'),
        'your_ip' => $req->ip(),
        'content_length' => strlen($req->getContent())
    ]);
});

Route::get('/testmail', function () {
    $payment = \App\Models\Payment::first();

    Mail::to($payment->email)->send(new \App\Mail\PaymentStatusMail($payment));

    return "done";
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==================== ADMIN ROUTES ====================
Route::middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/projects/{id}', [DashboardController::class, 'getProject'])->name('projects.show');

    // API Routes
    Route::prefix('api')->group(function () {
        Route::get('/dashboard/stats', [DashboardController::class, 'getStats']);
        Route::get('/projects/{id}', [DashboardController::class, 'getProject']);
        Route::post('/projects', [DashboardController::class, 'storeProject']);
        Route::get('/subscribers', [DashboardController::class, 'getSubscribers']);
        Route::post('/subscribers', [DashboardController::class, 'storeSubscriber']);
    });

    // ==================== ITINERARY BUILDER ROUTES ====================
    Route::prefix('admin/itinerary-builder')->name('admin.itinerary-builder.')->group(function () {
        // Main views
        Route::get('/', [ItineraryBuilderController::class, 'index'])->name('index');
        Route::get('/create', [ItineraryBuilderController::class, 'create'])->name('create');
        Route::get('/{id}/edit', [ItineraryBuilderController::class, 'edit'])->name('edit');

        // CRUD operations
        Route::post('/', [ItineraryBuilderController::class, 'store'])->name('store');
        Route::put('/{id}', [ItineraryBuilderController::class, 'update'])->name('update');
        Route::delete('/{id}', [ItineraryBuilderController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/publish', [ItineraryBuilderController::class, 'publish'])->name('publish');

        // API endpoints untuk builder
        Route::get('/api/places', [ItineraryBuilderController::class, 'getPlaces'])->name('api.places');
        Route::get('/api/cities', [ItineraryBuilderController::class, 'getCities'])->name('api.cities');
        Route::get('/api/categories', [ItineraryBuilderController::class, 'getCategories'])->name('api.categories');
        Route::post('/api/calculate-route', [ItineraryBuilderController::class, 'calculateRoute'])->name('api.calculate-route');
    });

    Route::patch('/admin/itinerary-builder/{id}/toggle-status', [ItineraryBuilderController::class, 'toggleStatus'])->name('admin.itinerary-builder.toggle-status');

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.app');
    Route::post('/admin/update', [AdminController::class, 'update'])->name('admin.update');

    // User Management — khusus superadmin
    Route::get('/admin/users', [AccountController::class, 'index'])->name('admin.users');
    Route::post('/admin/users/store', [AccountController::class, 'store'])->name('admin.user.store');
    Route::post('/admin/users/update/{id}', [AccountController::class, 'update'])->name('admin.user.update');
    Route::delete('/admin/users/delete/{id}', [AccountController::class, 'delete'])->name('admin.user.delete');

    // Tambahan: create user dengan role (superadmin only)
    Route::middleware('isSuperAdmin')->group(function () {
        Route::get('/admin/users/create', [AuthController::class, 'showCreateUser'])->name('admin.create-user');
        Route::post('/admin/users/create', [AuthController::class, 'createUser'])->name('admin.store-user');
    });

    Route::get('/admin/profile', function () {
        return view('admin.profile');
    })->middleware('auth')->name('admin.profile');

    Route::post('/admin/profile/update', [AuthController::class, 'updateProfile'])
        ->middleware('auth')->name('admin.profile.update');

    Route::post('/admin/profile/password', [AuthController::class, 'updatePassword'])
        ->middleware('auth')->name('admin.profile.password');

    Route::delete('/admin/profile/delete', [AuthController::class, 'deleteAccount'])
        ->name('admin.profile.delete');

    Route::get('/admin/leads', [AdminLeadsController::class, 'lead']);
    Route::post('/admin/leads/store', [AdminLeadsController::class, 'store'])->name('admin.leads.store');
    Route::post('/admin/leads/{lead}/contact', [AdminLeadsController::class, 'contact']);
    Route::post('/admin/leads/{lead}/status', [AdminLeadsController::class, 'updateStatus']);

    Route::get('/admin/booking', [AdminBookingsController::class, 'index']);
    Route::get('/admin/booking/data', [AdminBookingsController::class, 'data']);
    Route::post('/admin/booking/{id}/{status}', [AdminBookingsController::class, 'updateStatus']);
    Route::post('/admin/event-booking/{id}/{status}', [AdminBookingsController::class, 'updateEventStatus']);
});

Route::middleware(['auth', 'isPartner'])->group(function () {
    Route::get('/partner', function () {
        return view('partner.app');
    })->name('partner.app');
});
