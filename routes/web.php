<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\PatientController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Superadmin Routes
    Route::middleware('role:superadmin')->group(function () {
        Route::get('/superadmin/users', function () {
            return "Superadmin Users Management Page";
        })->name('superadmin.users');
    });

    // User Routes
    Route::middleware('role:user')->group(function () {
        // Halaman Daftar
        Route::get('/patients', [PatientController::class, 'index'])
            ->name('user.patients');

        // Halaman Tambah
        Route::get('/patients/create', [PatientController::class, 'create'])
            ->name('patients.create');

        Route::post('/patients', [PatientController::class, 'store'])
            ->name('patients.store');

        // Halaman Detail
        Route::get('/patients/{id}', [PatientController::class, 'show'])
            ->name('patients.show');

        // --- TAMBAHAN EDIT DI SINI ---
        Route::get('/patients/{id}/edit', [PatientController::class, 'edit'])
            ->name('patients.edit');

        Route::put('/patients/{id}', [PatientController::class, 'update'])
            ->name('patients.update');
        // -----------------------------

        // Fitur Hapus
        Route::delete('/patients/{id}', [PatientController::class, 'destroy'])
            ->name('patients.destroy');

        // --- TAMBAHAN UNTUK REKAM MEDIS ---
        Route::get('/rekam-medis', [RekamMedisController::class, 'index'])->name('rekam-medis.index');
        Route::get('/rekam-medis/create', [RekamMedisController::class, 'create'])->name('rekam-medis.create');
        Route::post('/rekam-medis', [RekamMedisController::class, 'store'])->name('rekam-medis.store');
        Route::get('/rekam-medis/{id}', [RekamMedisController::class, 'show'])->name('rekam-medis.show');

        Route::get('/doctors', function () {
            return "Doctors Management Page";
        })->name('user.doctors');

        Route::get('/medicines', function () {
            return "Medicines Management Page";
        })->name('user.medicines');

        Route::get('/medical-records', function () {
            return "Medical Records Management Page";
        })->name('user.records');
    });
});