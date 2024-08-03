<?php

use App\Http\Controllers\admin\Auth\adminAuthController;
use App\Http\Controllers\API\JurusanController;
use App\Http\Controllers\API\KelasController;
use App\Http\Controllers\capaianJamController;
use App\Http\Controllers\GambarController;
use App\Http\Controllers\JadwalMengajarController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\user\Auth\userAuthController;
use App\Http\Controllers\user\GuruController;
use Illuminate\Support\Facades\Route;

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

// Guru
Route::group(['prefix' => 'guru'], function () {
    Route::get('/', [GuruController::class, 'index']);
    Route::get('/{id}', [GuruController::class, 'cariGuru']);
    Route::put('/{id}', [GuruController::class, 'rubahGuru']);
    Route::post('/register', [GuruController::class, 'tambahGuru']);
    Route::delete('{id}', [GuruController::class, 'hapusGuru']);
    Route::post('validate-password', [GuruController::class, 'validatePassword']);
});

Route::group(['prefix' => 'siswa'], function () {
    Route::get('/', [SiswaController::class, 'index']);
    Route::get('/{id}', [SiswaController::class, 'cariSiswa']);
    // Route::put('/{id}', [GuruController::class, 'rubahGuru']);
    Route::post('/register', [SiswaController::class, 'registerSiswa']);
    // Route::delete('{id}', [GuruController::class, 'hapusGuru']);
    // Route::post('validate-password', [GuruController::class,'validatePassword']);
});

// Auth Guru/ Flutter
Route::post('auth/register', [userAuthController::class, 'register']);
Route::post('auth/login', [userAuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('auth/profile', [userAuthController::class, 'profile']);
    Route::post('auth/logout', [userAuthController::class, 'logout']);
});

Route::post('admin/register', [adminAuthController::class, 'register']);
// Auth Admin
Route::post('admin/login', [adminAuthController::class, 'login']);
// mata pelajaran

Route::prefix('mata-pelajaran')->group(function () {
    Route::get('/', [mapelController::class, 'index']);
    Route::get('/{id}', [mapelController::class, 'cariMapel']);
    Route::post('/add', [mapelController::class, 'addMapel']);
    Route::put('/{id}', [mapelController::class, 'rubahMapel']);
    Route::delete('{id}', [mapelController::class, 'hapusMapel']);
});

// jurusan
Route::prefix('tugas')->group(function () {
    Route::get('/', [tugasController::class, 'tampil_jurusan']);
    Route::get('/{id}', [JurusanController::class, 'cari_jurusan']);
    Route::post('/', [tugasController::class, 'tambahTugas']);
    Route::put('/{id}', [JurusanController::class, 'rubah_jurusan']);
    Route::delete('/{id}', [JurusanController::class, 'hapus_jurusan']);
});
// kelas
Route::prefix('kelas')->group(function () {
    Route::get('/', [KelasController::class, 'index']);
    Route::get('/{id}', [KelasController::class, 'show']);
    Route::post('/', [KelasController::class, 'store']);
    Route::put('/{id}', [KelasController::class, 'update']);
    Route::delete('/{id}', [KelasController::class, 'destroy']);
});

// jadwal mengajar
Route::prefix('jadwal-mengajar')->group(function () {
    Route::get('/', [JadwalMengajarController::class, 'index']);
    Route::get('/{id}', [JadwalMengajarController::class, 'show']);
    Route::post('/', [JadwalMengajarController::class, 'store']);
    Route::put('/{id}', [JadwalMengajarController::class, 'update']);
    Route::delete('/{id}', [JadwalMengajarController::class, 'destroy']);
});

// Route::post('multiple-upload-file', [GambarController::class, 'store']);
// Route::get('laporan/', [LaporanController::class, 'index']);
// Route::post('laporan/create', [LaporanController::class, 'store']);
// Route::get('laporan/{id}', [LaporanController::class, 'show']);

Route::prefix('laporan')->group(function () {
    Route::get('/', [LaporanController::class, 'index']);
    Route::get('/{id}', [LaporanController::class, 'show']);
    Route::post('/create', [LaporanController::class, 'store']);
    Route::put('/{id}', [LaporanController::class, 'update']);
    Route::delete('/{id}', [LaporanController::class, 'delete']);
});

Route::prefix('capaian-jam')->group(function () {
    Route::get('/', [capaianJamController::class, 'index']);
    Route::post('/add', [capaianJamController::class, 'store']);
    Route::delete('/{id}', [capaianJamController::class, 'destroy']);
    Route::patch('/tambah/{id}', [capaianJamController::class, 'update']);
    Route::patch('/update/{id}', [capaianJamController::class, 'updateAll']);
    Route::get('/{id}', [capaianJamController::class, 'show']);
});
