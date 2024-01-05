<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[AuthenticationController::class,'login'])->name('login');
Route::post('/login-check',[AuthenticationController::class,'loginCheck'])->name('login.check');

Route::group(['middleware' => ['auth','preventBackHistory']], function () {
    Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
    Route::get('/logout',[AuthenticationController::class,'logout'])->name('logout');

    Route::get('/profile',[ProfileController::class,'profile'])->name('profile');
    Route::get('/change-password',[ProfileController::class,'changePassword'])->name('change.password');
    Route::post('/profile-update',[ProfileController::class,'profileUpdate'])->name('profile.update');
    Route::post('/password-update',[ProfileController::class,'passwordUpdate'])->name('password.update');

    // Setting
    Route::group(['prefix' => 'setting'], function () {
        Route::get('/social-media',[SettingController::class,'socialMedia'])->name('social-media');
        Route::get('/support',[SettingController::class,'support'])->name('support');

        // members
        Route::group(['prefix' => 'members'], function () {
            Route::get('/',[SettingController::class,'members'])->name('members.index');
            Route::post('/store',[SettingController::class,'membersStore'])->name('members.store');
            Route::get('/edit/{id}',[SettingController::class,'membersEdit'])->name('members.edit');
            Route::put('/update/{id}',[SettingController::class,'membersUpdate'])->name('members.update');
            Route::get('/delete/{id}',[SettingController::class,'membersDelete'])->name('members.delete');
            Route::get('/filter',[SettingController::class,'memberFilter'])->name('members.filter');
        });

        // user-access
        Route::group(['prefix' => 'user-access'], function () {
            Route::get('/',[SettingController::class,'userAccess'])->name('user-access.index');
            Route::post('/store',[SettingController::class,'userAccessStore'])->name('user-access.store');
            Route::get('/edit/{id}',[SettingController::class,'userAccessEdit'])->name('user-access.edit');
            Route::put('/update/{id}',[SettingController::class,'userAccessUpdate'])->name('user-access.update');
            Route::get('/delete/{id}',[SettingController::class,'userAccessDelete'])->name('user-access.delete');
            Route::get('/filter',[SettingController::class,'userAccessFilter'])->name('user-access.filter');
        });
    });
});