<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\CandidateJobController;
use App\Http\Controllers\Api\FeedController;
use App\Http\Controllers\Api\ReferController;
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
    Route::post('job-interest', [AuthenticationController::class, 'jobInterest']);

    Route::middleware('auth:api')->group(function () {
        Route::prefix('job')->group(function () {
            Route::post('list', [JobController::class, 'list']);
        });

        Route::prefix('candidate-job')->group(function () {
            Route::post('apply', [CandidateJobController::class, 'candidateJobApply']);
            Route::post('detail', [CandidateJobController::class, 'candidateJobDetail']);
            Route::post('list', [CandidateJobController::class, 'candidateJobList']);

        });

        Route::prefix('profile')->group(function () {
            Route::post('my', [ProfileController::class, 'my']);
            Route::post('update', [ProfileController::class, 'update']);
            Route::post('edit', [ProfileController::class, 'edit']);
            Route::post('delete', [ProfileController::class, 'delete']);
        });

        Route::prefix('feeds')->group(function () {
            Route::post('list', [FeedController::class, 'feedList']);
            Route::post('like', [FeedController::class, 'feedLike']);
            Route::post('detail', [FeedController::class, 'feedDetail']);
        });

        Route::prefix('settings')->group(function () {
            Route::post('contact-us', [SettingController::class, 'contactUs']);
            Route::post('additional-page', [SettingController::class, 'additionalPage']);
        });

        Route::prefix('referral')->group(function (){
            route::post('view', [ReferController::class, 'view']);
            Route::post('submit',[ReferController::class, 'submit']);
            Route::post('total-point', [ReferController::class, 'totalPoint']);
        });
    });
});
