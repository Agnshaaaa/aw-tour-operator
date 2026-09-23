<?php

use App\Http\Controllers\Admin\CalendarController as AdminCalendarController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DestinationController as AdminDestinationController;
use App\Http\Controllers\Admin\RequestController as AdminRequestController;
use App\Http\Controllers\Admin\UmkmController as AdminUmkmController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CustomRequestController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OpenTripController;
use App\Http\Controllers\UmkmController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — AW Tour Operator Surabaya
|--------------------------------------------------------------------------
|
| Terbagi menjadi 2 kelompok utama:
| 1. Route Publik (Company Profile, Katalog, Quotation Builder, Kalender, UMKM)
| 2. Route Admin (Autentikasi & Panel Admin untuk Kelola Permintaan Rombongan)
|
*/

// =========================================================================
// 1. ROUTE PUBLIK (Akses Terbuka)
// =========================================================================

// Halaman Utama / Landing Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Katalog Destinasi Wisata
Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinations/{slug}', [DestinationController::class, 'show'])->name('destinations.show');

// Custom Group Quotation Builder (Form Multi-step Rombongan)
Route::get('/quotation/builder', [CustomRequestController::class, 'create'])->name('quotation.create');
Route::post('/quotation/builder', [CustomRequestController::class, 'store'])->name('quotation.store');
Route::get('/quotation/success/{ticket_number}', [CustomRequestController::class, 'success'])->name('quotation.success');

// Jadwal Open Trip (Lead Generator)
Route::get('/open-trips', [OpenTripController::class, 'index'])->name('open-trips.index');
Route::get('/open-trips/{id}', [OpenTripController::class, 'show'])->name('open-trips.show');

// Etalase Oleh-oleh Produk UMKM
Route::get('/umkm', [UmkmController::class, 'index'])->name('umkm.index');
Route::get('/umkm/{slug}', [UmkmController::class, 'show'])->name('umkm.show');

// Interactive Availability Calendar (Ketersediaan Tanggal)
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');


// =========================================================================
// 2. ROUTE AUTENTIKASI ADMIN
// =========================================================================

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});


// =========================================================================
// 3. ROUTE PANEL ADMIN (Membutuhkan Login & Role Admin)
// =========================================================================

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard Ringkasan & Statistik
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Permintaan Quotation Rombongan
    Route::get('/requests', [AdminRequestController::class, 'index'])->name('requests.index');
    Route::get('/requests/{id}', [AdminRequestController::class, 'show'])->name('requests.show');
    Route::patch('/requests/{id}/status', [AdminRequestController::class, 'updateStatus'])->name('requests.update-status');
    Route::delete('/requests/{id}', [AdminRequestController::class, 'destroy'])->name('requests.destroy');

    // Kelola Kalender Tanggal Terpesan (Booked Dates)
    Route::get('/calendar', [AdminCalendarController::class, 'index'])->name('calendar.index');
    Route::post('/calendar', [AdminCalendarController::class, 'store'])->name('calendar.store');
    Route::delete('/calendar/{id}', [AdminCalendarController::class, 'destroy'])->name('calendar.destroy');

    // CRUD Katalog Destinasi Wisata
    Route::resource('destinations', AdminDestinationController::class);

    // CRUD Katalog Produk UMKM
    Route::resource('umkm', AdminUmkmController::class);
});
