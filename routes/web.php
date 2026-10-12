<?php

use App\Http\Controllers\AbsensiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RelawanController;
use App\Http\Controllers\ProfilAdminController;
use App\Http\Controllers\AdminUserController;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::get('/login', [AuthController::class, 'showLogin']);
    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.process');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [RelawanController::class, 'index'])
        ->name('dashboard');

    Route::post('/relawan', [RelawanController::class, 'store'])
        ->name('relawan.store');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
    Route::get('/profil-admin', [ProfilAdminController::class, 'index'])
    ->name('profil-admin');

    Route::put('/profil-admin/password', [ProfilAdminController::class, 'updatePassword'])
        ->name('profil-admin.password');
        Route::get('/relawan/{relawan}/edit', [RelawanController::class, 'edit'])
        ->name('relawan.edit');

    Route::put('/relawan/{relawan}', [RelawanController::class, 'update'])
        ->name('relawan.update');

    Route::delete('/relawan/{relawan}', [RelawanController::class, 'destroy'])
        ->name('relawan.destroy');
    Route::get('/absensi/{absensi}/edit', [AbsensiController::class, 'edit'])
    ->name('absensi.edit');

Route::put('/absensi/{absensi}', [AbsensiController::class, 'update'])
    ->name('absensi.update');

    Route::post('/admin/users', [AdminUserController::class, 'store'])
    ->middleware('auth')
    ->name('admin.users.store');
});

Route::get('/monitoring-absensi', [AbsensiController::class, 'index'])
    ->name('absensi.monitoring');

Route::post('/absensi/scan', [AbsensiController::class, 'scan'])
    ->name('absensi.scan');
    Route::get('/scan-rfid', function () {
    return view('scan');
})->name('absensi.form');