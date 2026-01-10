<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DokterController; // <--- JANGAN LUPA INI
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Role Superadmin
    Route::middleware('role:superadmin')->group(function () {
        Route::get('/superadmin/users', function () {
            return "Halaman Superadmin";
        })->name('superadmin.users');
    });

    // Role User (TUGASMU DI SINI)
    Route::middleware('role:user')->group(function () {
        
        Route::get('/patients', function () { return "Patients Page"; })->name('user.patients');

        // === KODE TUGAS KAMU (ORANG 5) ===
        Route::resource('dokter', DokterController::class);
        // =================================

        Route::get('/medicines', function () { return "Medicines Page"; })->name('user.medicines');
        Route::get('/medical-records', function () { return "Records Page"; })->name('user.records');
    });
});