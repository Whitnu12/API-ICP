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


Route::post('/admin/login', [adminAuthController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [adminAuthController::class, 'logout'])->name('admin.logout');
// Route::get('/admin/dashboard', [adminAuthController::class, 'dashboard'])->name('admin.dashboard');
Route::view('/admin/dashboard', 'admin')->name('admin.dash');
Route::view('admin/dashboard/home','home')->name('home');
Route::view('admin/dashboard/guru','coba123')->name('guru');

use App\Http\Controllers\admin\Auth\UserDashboardController;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/admin/login', [adminAuthController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [adminAuthController::class, 'logout'])->name('admin.logout');
Route::view('/admin/dashboard', 'admin')->name('admin.dash');
Route::view('/admin/dashboard/home', 'home')->name('home');
Route::view('/admin/dashboard/guru', 'coba123')->name('guru');