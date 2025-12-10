<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('Explore', [App\Http\Controllers\HomeController::class, 'explore']);
Route::get('Province/{province}', [App\Http\Controllers\ProvinceController::class, 'show'])->name('province.show');
Route::get('About', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('Tour', [App\Http\Controllers\HomeController::class, 'indonesia']);
Route::get('Custom-Form', [App\Http\Controllers\HomeController::class, 'customForm']);
Route::get('/tour/detail/{kode}', [App\Http\Controllers\TourController::class, 'details']);
Route::get('Destination', [App\Http\Controllers\HomeController::class, 'destination'])->name('destination');
Route::get('Experience', [App\Http\Controllers\AttractionController::class, 'experience'])->name('experience');
Route::get('/attraction/{id}', [App\Http\Controllers\AttractionController::class, 'show'])->name('show');
Route::get('Booking', [App\Http\Controllers\HomeController::class, 'booking'])->name('booking-form');
Route::post('/payment/doku/create', [App\Http\Controllers\PaymentController::class, 'createDoku']);
Route::post('/payment/doku/callback', [App\Http\Controllers\PaymentController::class, 'callback']);
Route::get('/payment/processing', [App\Http\Controllers\PaymentController::class, 'processing']);
Route::get('/payment/status/{invoice}', [App\Http\Controllers\PaymentController::class, 'checkStatus']);
Route::get('/testmail', function () {
    $payment = \App\Models\Payment::first(); // ambil data dummy

    Mail::to($payment->email)->send(new \App\Mail\PaymentStatusMail($payment));

    return "done";
});


Route::get('/Login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/Login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
Route::get('/Register', [App\Http\Controllers\AuthController::class, 'showRegister'])->name('register');
Route::post('/Register', [App\Http\Controllers\AuthController::class, 'register'])->name('register.post');
Route::get('/Logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('Dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.app');
});

Route::prefix('admin')->group(function () {

    Route::get('/staff', [App\Http\Controllers\AccountController::class, 'index'])->name('admin.staff.index');
    Route::post('/staff/store', [App\Http\Controllers\AccountController::class, 'store'])->name('admin.staff.store');
    Route::post('/staff/update', [App\Http\Controllers\AccountController::class, 'update'])->name('admin.staff.update');
    Route::delete('/staff/delete/{id}', [App\Http\Controllers\AccountController::class, 'destroy'])->name('admin.staff.delete');
});
