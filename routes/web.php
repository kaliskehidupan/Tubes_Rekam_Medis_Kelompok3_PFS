<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasienController;
use Illuminate\Support\Facades\Route;

// Redirect root ke dashboard
Route::get('/', function () { return redirect()->route('dashboard'); });

// Fitur untuk Tamu (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Fitur untuk yang sudah Login (Auth)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

    // Superadmin: Hanya bisa akses Manajemen User
    Route::middleware('role:superadmin')->group(function () {
        Route::resource('users', UserController::class);
    });

    // User (Medis): Akses Fitur Utama
    Route::middleware('role:user')->group(function () {
        Route::resource('pasien', PasienController::class)->names([
            'index' => 'user.patients'
        ]);

        Route::get('/doctors', function () { return "Halaman Dokter"; })->name('user.doctors');
        Route::get('/medicines', function () { return "Halaman Obat"; })->name('user.medicines');
        Route::get('/medical-records', function () { return "Halaman Rekam Medis"; })->name('user.records');
    });
});
