<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('Explore-Indonesia', [App\Http\Controllers\HomeController::class, 'explore']);
Route::get('Province/{province}', [App\Http\Controllers\ProvinceController::class, 'show'])->name('province.show');
Route::get('About', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('Tour', [App\Http\Controllers\HomeController::class, 'indonesia']);
Route::get('Custom-Form', [App\Http\Controllers\HomeController::class, 'customForm']);
Route::get('/tour/detail/{kode}', [App\Http\Controllers\TourController::class, 'details']);


Route::get('Destination', [App\Http\Controllers\HomeController::class, 'destination'])->name('destination');
Route::get('Experience', [App\Http\Controllers\HomeController::class, 'experience'])->name('experience');
Route::get('Booking', [App\Http\Controllers\HomeController::class, 'booking'])->name('booking-form');


Route::get('/Login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/Login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
Route::get('/Register', [App\Http\Controllers\AuthController::class, 'showRegister'])->name('register');
Route::post('/Register', [App\Http\Controllers\AuthController::class, 'register'])->name('register.post');
Route::get('/Logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('Dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.app');
});

Route::get('/', fn() => view('home'))->name('home');
