<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('Explore', [App\Http\Controllers\HomeController::class, 'explore']);
Route::get('Province/{province}', [App\Http\Controllers\ProvinceController::class, 'show'])->name('province.show');
Route::get('About', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('Tour', [App\Http\Controllers\HomeController::class, 'indonesia']);
Route::get('FAQ', [App\Http\Controllers\HomeController::class, 'faq']);
Route::get('terms', [App\Http\Controllers\HomeController::class, 'terms']);
Route::get('privacy', [App\Http\Controllers\HomeController::class, 'privacy']);
Route::get('Custom-Form', [App\Http\Controllers\HomeController::class, 'customForm']);
Route::get('/tour/detail/{kode}', [App\Http\Controllers\TourController::class, 'details']);
Route::get('Destination', [App\Http\Controllers\HomeController::class, 'destination'])->name('destination');
Route::get('Experience', [App\Http\Controllers\AttractionController::class, 'experience'])->name('experience');
Route::get('/attraction/{id}', [App\Http\Controllers\AttractionController::class, 'show'])->name('show');
Route::get('Booking', [App\Http\Controllers\HomeController::class, 'booking'])->name('booking-form');
Route::get('Profile', [App\Http\Controllers\HomeController::class, 'profil']);
Route::get('Dashboard', [App\Http\Controllers\HomeController::class, 'client']);
Route::post('/send-inquiry', [App\Http\Controllers\TourController::class, 'send']);
Route::post('/payment/doku/create', [App\Http\Controllers\PaymentController::class, 'createDoku']);

Route::post('/payment/doku/notify', [App\Http\Controllers\PaymentController::class, 'notify']);
Route::post('/payment/doku/callback', [App\Http\Controllers\PaymentController::class, 'callback']);
Route::post('/payment/doku/credit-card-webhook', [App\Http\Controllers\PaymentController::class, 'creditCardWebhook']);
Route::get('/payment/return', [App\Http\Controllers\PaymentController::class, 'returnHandler']);
Route::get('/payment/status/{invoice}', [App\Http\Controllers\PaymentController::class, 'checkStatus']);
Route::get('/payment/processing/{invoice}', [App\Http\Controllers\PaymentController::class, 'processing']);
Route::post('/payment/create-doku', [App\Http\Controllers\PaymentController::class, 'createDoku']);
Route::get('/payment/simulate-notify', [App\Http\Controllers\PaymentController::class, 'simulateNotification']);

Route::get('/form-event', [App\Http\Controllers\FormEventController::class, 'showForm'])->name('form.event');

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


Route::get('/Login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/Login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
Route::get('/Register', [App\Http\Controllers\AuthController::class, 'showRegister'])->name('register');
Route::post('/Register', [App\Http\Controllers\AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])
        ->name('admin.app');

    Route::post('/admin/update', [App\Http\Controllers\AdminController::class, 'update'])
        ->name('admin.update');

    Route::get('/admin/users', [App\Http\Controllers\AccountController::class, 'index'])->name('admin.users');
    Route::post('/admin/users/store', [App\Http\Controllers\AccountController::class, 'store'])->name('admin.user.store');
    Route::post('/admin/users/update/{id}', [App\Http\Controllers\AccountController::class, 'update'])->name('admin.user.update');
    Route::delete('/admin/users/delete/{id}', [App\Http\Controllers\AccountController::class, 'delete'])->name('admin.user.delete');

    Route::get('/admin/tours', [App\Http\Controllers\AdminToursController::class, 'index'])->name('admin.tours');

    Route::get('/admin/profile', function () {
        return view('admin.profile');
    })->middleware('auth')->name('admin.profile');

    Route::post('/admin/profile/update', [App\Http\Controllers\AuthController::class, 'updateProfile'])
        ->middleware('auth')->name('admin.profile.update');

    Route::post('/admin/profile/password', [App\Http\Controllers\AuthController::class, 'updatePassword'])
        ->middleware('auth')->name('admin.profile.password');

    Route::delete('/admin/profile/delete', [App\Http\Controllers\AuthController::class, 'deleteAccount'])
        ->name('admin.profile.delete');

    Route::get('/admin/leads', [App\Http\Controllers\AdminLeadsController::class, 'lead']);
    Route::post('/admin/leads/store', [App\Http\Controllers\AdminLeadsController::class, 'store'])->name('admin.leads.store');
    Route::post('/admin/leads/{lead}/contact', [App\Http\Controllers\AdminLeadsController::class, 'contact']);
    Route::post('/admin/leads/{lead}/status', [App\Http\Controllers\AdminLeadsController::class, 'updateStatus']);

    Route::get('/admin/booking', [App\Http\Controllers\AdminBookingsController::class, 'index'])->name('admin.booking');
    Route::post('/admin/booking/{id}/{status}', [App\Http\Controllers\AdminBookingsController::class, 'updateStatus']);
});
