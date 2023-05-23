<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\Auth\adminAuthController;

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
    return view('login');
})->name('login');

Route::middleware('auth:admin')->group(function () {
    Route::view('/dashboard', 'admin/dashboard')->name('dashboard');
    Route::view('/dashboard/guru', 'admin/guru')->name('guru');
    Route::view('/dashboard/ptk', 'admin/ptk')->name('ptk');
    Route::view('/dashboard/matapelajaran', 'admin/mataPelajaran')->name('mapel');
    Route::view('/dashboard/sekolah', 'admin/sekolah')->name('sekolah');
    Route::view('/dashboard/laporan', 'admin/laporan')->name('laporan');
});

Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('/admin/register', [AdminAuthController::class, 'register'])->name('admin.register');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


