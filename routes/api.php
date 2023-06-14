<?php

use App\Http\Controllers\user\GuruController;
use App\Http\Controllers\user\Auth\userAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\Auth\adminAuthController;
use App\Http\Controllers\admin\adminMataPelajaranController;
use App\Http\Controllers\API\JurusanController;
use App\Http\Controllers\API\KelasController;
use App\Http\Controllers\JadwalMengajarController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


//Guru
Route::group(['prefix' => 'guru'], function () {
    Route::get('/', [GuruController::class, 'index']);
    Route::get('/{id}', [GuruController::class, 'cariGuru']);
    Route::put('/{id}', [GuruController::class, 'rubahGuru']);
    Route::post('/register', [GuruController::class, 'tambahGuru']);
    Route::delete('{id}', [GuruController::class, 'hapusGuru']);
    Route::post('validate-password', [GuruController::class,'validatePassword']);
});


// Auth Guru/ Flutter
Route::post('auth/register',[userAuthController::class,'register']);
Route::post('auth/login', [userAuthController::class,'login']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('auth/profile', [userAuthController::class, 'profile']);
    Route::post('auth/logout', [userAuthController::class, 'logout']);
});

Route::post('admin/register', [adminAuthController::class, 'register']);
// Auth Admin


//mata pelajaran

Route::prefix('mata-pelajaran')->group(function(){
    Route::get('/', [adminMataPelajaranController::class, 'indexMapel']);
    Route::get('/{id}', [adminMataPelajaranController::class, 'cariMapel']);
    Route::post('/add', [adminMataPelajaranController::class, 'addMapel']);
    Route::put('/{id}', [adminMataPelajaranController::class, 'rubahMapel']);
    Route::delete('{id}', [adminMataPelajaranController::class, 'hapusMapel']);
    });

    //jurusan
Route::prefix('jurusan')->group(function () {
    Route::get('/', [JurusanController::class, 'tampil_jurusan']);
    Route::get('/{id}', [JurusanController::class, 'cari_jurusan']);
    Route::post('/', [JurusanController::class, 'tambah_jurusan']);
    Route::put('/{id}', [JurusanController::class, 'rubah_jurusan']);
    Route::delete('/{id}', [JurusanController::class, 'hapus_jurusan']);
});
    //kelas
Route::prefix('kelas')->group(function () {
    Route::get('/', [KelasController::class, 'index']);
    Route::get('/{id}', [KelasController::class, 'show']);
    Route::post('/', [KelasController::class, 'store']);
    Route::put('/{id}', [KelasController::class, 'update']);
    Route::delete('/{id}', [KelasController::class, 'destroy']);
});

    //jadwal mengajar   
Route::prefix('jadwal-mengajar')->group(function(){
    Route::get('/', [JadwalMengajarController::class, 'index']);
    Route::get('/{id}', [JadwalMengajarController::class, 'show']);
    Route::post('/', [JadwalMengajarController::class, 'store']);
    Route::put('/{id}', [JadwalMengajarController::class, 'update']);
    Route::delete('/{id}', [JadwalMengajarController::class, 'destroy']);
});

Route::prefix('laporan')->group(function(){
    Route::get('/', [LaporanController::class, 'index']);
    // Route::get('/{id}', [JadwalMengajarController::class, 'show']);
    Route::post('/', [LaporanController::class, 'store']);

});

