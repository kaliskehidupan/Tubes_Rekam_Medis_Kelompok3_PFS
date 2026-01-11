<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasienController; // Gunakan satu nama saja agar tidak bingung
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
    
    // Dashboard Utama
    Route::get('/dashboard', function () { 
        return view('dashboard'); 
    })->name('dashboard');

    // --- AREA SUPERADMIN ---
    Route::middleware('role:superadmin')->group(function () {
        Route::resource('users', UserController::class);
    });

    // --- AREA USER (PETUGAS/MEDIS) ---
    Route::middleware('role:user')->group(function () {
        
        // Data Pasien (Menggunakan Resource agar Simple)
        Route::resource('pasien', PasienController::class)->names([
            'index' => 'user.patients',
            'create' => 'patients.create',
            'store' => 'patients.store',
            'show' => 'patients.show',
            'edit' => 'patients.edit',
            'update' => 'patients.update',
            'destroy' => 'patients.destroy',
        ]);

        // Data Dokter
        Route::resource('dokter', DokterController::class);

        // Data Obat
        Route::resource('obat', ObatController::class);
        Route::get('/medicines', [ObatController::class, 'index'])->name('user.medicines');

        // Data Rekam Medis
        Route::resource('rekam-medis', RekamMedisController::class)->names([
            'index' => 'rekam-medis.index',
            'create' => 'rekam-medis.create',
            'store' => 'rekam-medis.store',
            'show' => 'rekam-medis.show',
        ]);
        
        // Route cadangan untuk sidebar jika diperlukan
        Route::get('/medical-records', [RekamMedisController::class, 'index'])->name('user.records');
    });
});