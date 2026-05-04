<?php

use App\Http\Controllers\ContributionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;

// Halaman Depan
Route::get('/', function () {
    return view('welcome');
});

// Login
Route::get('/login', function () {
    return view('pages.login');
})->name('login');

// Dashboard Utama
Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.dashboard');

// Route::resource sudah mencakup index, create, store, edit, update, dan destroy.
Route::resource('member', MemberController::class);

// Tambahkan rute ini agar menu "Data Anggota" di sidebar Anda tetap bekerja
Route::get('/admin/anggota', [MemberController::class, 'index'])->name('admin.anggota');

// Halaman Manajemen Iuran
Route::resource('admin/contributions', ContributionController::class)->names([
    'index' => 'contributions.index',
]);


Route::get('/admin/contributions', [ContributionController::class, 'index'])->name('admin.contributions.index');

// untuk pembayaran cash
Route::post('/admin/contributions/pay-cash/{member_id}', [ContributionController::class, 'payCash'])
    ->name('admin.contributions.payCash');
