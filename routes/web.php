<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\ObatController;
use Illuminate\Support\Facades\Route;

// 1. Redirect root ke dashboard
Route::get('/', function () { 
    return redirect()->route('dashboard'); 
});

// 2. Fitur untuk Tamu (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// 3. Fitur untuk yang sudah Login (Auth)
Route::middleware('auth')->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard Utama (Bisa diakses Superadmin & User)
    Route::get('/dashboard', function () { 
        return view('dashboard'); 
    })->name('dashboard');

    // --- AREA SUPERADMIN ---
    Route::middleware('role:superadmin')->group(function () {
        // Resource untuk manajemen user
        Route::resource('users', UserController::class);
        // Route tambahan jika dibutuhkan
        Route::get('/superadmin/users-list', function () { 
            return "Halaman List User"; 
        })->name('superadmin.users');
    });

    // --- AREA USER (PETUGAS/MEDIS) ---
    Route::middleware('role:user')->group(function () {
        
        // Data Pasien
        Route::resource('pasien', PasienController::class)->names([
            'index' => 'user.patients'
        ]);

        // Data Dokter (Tugas Orang 5)
        Route::resource('dokter', DokterController::class);

        // Fitur Medis Lainnya
        Route::get('/medicines', function () { return "Halaman Obat"; })->name('user.medicines');
        Route::get('/medical-records', function () { return "Halaman Rekam Medis"; })->name('user.records');
        
        // Jika sudah ada Controller Rekam Medis & Obat, aktifkan ini:
        // Route::resource('obat', ObatController::class);
        // Route::resource('rekam-medis', RekamMedisController::class);
    });
});