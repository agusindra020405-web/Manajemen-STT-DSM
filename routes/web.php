<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', function () {
    return view('pages.login');
})->name('login');

Route::get('/admin', function () {
    return view('admin.index');
});

Route::get('/admin/anggota', function () {
    return view('admin.anggota');
})->name('admin.anggota');


Route::resource('member', MemberController::class);
Route::get('/admin/anggota', [MemberController::class, 'index']);
Route::livewire('/member/create', 'pages::member.create');
