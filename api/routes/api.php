<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ScheduleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Admin
Route::post('/login', [AuthController::class, 'login']);


Route::group(['middleware' => 'auth:sanctum'], function () {
    // Admin
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/getAllUsers', [AuthController::class, 'getAllUsers']);

    // Payment
    Route::post('/payment', [PaymentController::class, 'store']);
    Route::get('/payment', [PaymentController::class, 'index']);
});

Route::group(['prefix' => 'schedule'], function () {
    Route::post('/save', [ScheduleController::class, 'saveSchedule']);
});
