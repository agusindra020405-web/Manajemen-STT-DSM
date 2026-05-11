<?php

use App\Http\Controllers\ContributionController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes - Sistem Manajemen STT DSM
|--------------------------------------------------------------------------
*/

// --- 1. HALAMAN PUBLIK / GUEST ---
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

// Proses login
Route::post('/login', [LoginController::class, 'login']);

// Proses Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// --- 2. HALAMAN TERPROTEKSI (HARUS LOGIN) ---
Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // --- MANAJEMEN ANGGOTA ---
        Route::resource('member', MemberController::class);
        Route::get('anggota', [MemberController::class, 'index'])->name('admin.anggota');

        // --- MANAJEMEN IURAN (CONTRIBUTIONS) ---
        Route::get('contributions', [ContributionController::class, 'index'])->name('admin.contributions.index');

        // B. Proses Pembayaran Tunai (Hanya Admin yang akses di Blade)
        // Jika URL ini diakses langsung dengan GET, arahkan kembali ke daftar iuran.
        Route::get('contributions/pay-cash/{member_id}', function () {
            return redirect()->route('admin.contributions.index')->with('error', 'Akses langsung tidak didukung. Gunakan tombol Konfirmasi Tunai.');
        });

        Route::post('contributions/pay-cash/{member_id}', [ContributionController::class, 'payCash'])
            ->name('admin.contributions.payCash');

        // Resource tambahan (jika butuh create/edit/show)
        Route::resource('contributions', ContributionController::class)->except(['index']);

        // untuk dompdf dan create iuran
        Route::post('contributions/storeKolektif', [ContributionController::class, 'storeKolektif'])->name('admin.contributions.storeKolektif');
        Route::get('contributions/print/{id}', [ContributionController::class, 'printInvoice'])->name('admin.contributions.print');

        Route::post('contributions/cancel/{id}', [ContributionController::class, 'cancelPayment'])->name('admin.contributions.cancel');
    });
});
// tampilan anggota
Route::group(['prefix' => 'member', 'as' => 'member.'], function () {
    Route::get('/dashboard', [DashboardController::class, 'memberDashboard'])->name('dashboard');
    Route::get('/history', [DashboardController::class, 'memberHistory'])->name('history');
    Route::get('/settings', [DashboardController::class, 'memberSettings'])->name('settings');
    Route::put('/settings/password', [DashboardController::class, 'updatePassword'])->name('password.update');
    Route::get('/notifications', [DashboardController::class, 'memberNotifications'])->name('notifications');
});
