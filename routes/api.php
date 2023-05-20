<?php

use App\Http\Controllers\user\GuruController;
use App\Http\Controllers\user\Auth\userAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\Auth\adminAuthController;
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
    Route::get('/{id}', [GuruController::class, 'show']);
    Route::put('/{id}', [GuruController::class, 'update']);
    Route::post('/register', [GuruController::class, 'store']);
    Route::delete('{id}', [GuruController::class, 'destroy']);
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


