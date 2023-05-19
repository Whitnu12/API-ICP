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

Route::get('/admin/dashboard', [adminAuthController::class, 'dashboard'])->name('admin.dashboard');
Route::post('/admin/login', [adminAuthController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [adminAuthController::class, 'logout'])->name('admin.logout');
// Route::get('/admin/dashboard', [adminAuthController::class, 'dashboard'])->name('admin.dashboard');

Route::view('/dashboard', 'admin/dashboard')->name('dashboard');
Route::view('/dashboard/guru','admin/guru')->name('guru');
Route::view('/dashboard/ptk','admin/ptk')->name('ptk');


