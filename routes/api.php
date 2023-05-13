<?php

use App\Http\Controllers\GuruController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('guru')->group(function () {
    Route::get('/', [GuruController::class, 'index']);
    Route::get('/{id}', [GuruController::class, 'show']);
    Route::post('/', [GuruController::class, 'store']);
    Route::put('/{id}', [GuruController::class, 'update']);
    Route::delete('/{id}', [GuruController::class, 'destroy']);
});


Route::post('auth/register',[AuthController::class,'register']);
Route::post('auth/login', [AuthController::class,'login']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('auth/profile', [AuthController::class, 'profile']);
    Route::post('auth/logout', [AuthController::class, 'logout']);
});




