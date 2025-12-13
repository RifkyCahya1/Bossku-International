<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
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
Route::post('/send-inquiry', [App\Http\Controllers\TourController::class, 'send']);
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
});
