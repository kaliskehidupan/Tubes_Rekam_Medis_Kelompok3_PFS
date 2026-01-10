<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;


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
        Route::get('/patients', function () {
            return "Patients Management Page";
        })->name('user.patients');

        Route::get('/doctors', function () {
            return "Doctors Management Page";
        })->name('user.doctors');

        Route::resource('obat', ObatController::class);
        Route::get('/medicines', [ObatController::class, 'index'])->name('user.medicines');
        
        Route::get('/medicines', function () {
            return "Medicines Management Page";
        })->name('user.medicines');

        Route::get('/medical-records', function () {
            return "Medical Records Management Page";
        })->name('user.records');
    });
});
