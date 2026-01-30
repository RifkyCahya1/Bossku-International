<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('Explore', [HomeController::class, 'explore']);
Route::get('Province/{province}', [ProvinceController::class, 'show'])->name('province.show');
Route::get('About', [HomeController::class, 'about'])->name('about');
Route::get('Tour', [HomeController::class, 'indonesia']);
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
Route::get('/Partnership', [PartnershipController::class, 'partner']);
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


Route::get('/Login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/Login', [AuthController::class, 'login'])->name('login.post');
Route::get('/Register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/Register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.app');

    Route::post('/admin/update', [AdminController::class, 'update'])
        ->name('admin.update');

    Route::get('/admin/users', [AccountController::class, 'index'])->name('admin.users');
    Route::post('/admin/users/store', [AccountController::class, 'store'])->name('admin.user.store');
    Route::post('/admin/users/update/{id}', [AccountController::class, 'update'])->name('admin.user.update');
    Route::delete('/admin/users/delete/{id}', [AccountController::class, 'delete'])->name('admin.user.delete');

    Route::get('/admin/tours', [AdminToursController::class, 'index'])->name('admin.tours');

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

    Route::get('/admin/booking', [AdminBookingsController::class, 'index'])->name('admin.booking');
    Route::post('/admin/booking/{id}/{status}', [AdminBookingsController::class, 'updateStatus']);
});
