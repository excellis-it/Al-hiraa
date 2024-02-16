<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\SettingController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1'], function () {
    Route::post('request-otp', [AuthenticationController::class, 'requestOtp']);
    Route::post('login', [AuthenticationController::class, 'login']);
    Route::post('register', [AuthenticationController::class, 'register']);
    Route::post('request-otp-register', [AuthenticationController::class, 'requestOtpRegister']);
    Route::middleware('auth:api')->group(function () {
        Route::prefix('job')->group(function () {
            Route::post('list', [JobController::class, 'list']);
        });

        Route::prefix('profile')->group(function () {
            Route::post('my', [ProfileController::class, 'my']);
            Route::post('update', [ProfileController::class, 'update']);
            Route::post('edit', [ProfileController::class, 'edit']);
        });

        Route::prefix('settings')->group(function () {
            Route::post('contact-us', [SettingController::class, 'contactUs']);
            Route::post('additional-page', [SettingController::class, 'additionalPage']);
        });
    });
});
