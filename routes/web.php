<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
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
Route::post('forget-password', [AuthenticationController::class, 'forgetPassword'])->name('forget.password');
Route::get('forget-password/show', [AuthenticationController::class, 'forgetPasswordShow'])->name('forget.password.show');
Route::get('reset-password/{id}/{token}', [AuthenticationController::class, 'resetPassword'])->name('reset.password');

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
        });

        // positions
        Route::group(['prefix' => 'positions'], function () {
            Route::get('/',[SettingController::class,'positions'])->name('positions.index');
            Route::post('/store',[SettingController::class,'positionsStore'])->name('positions.store');
            Route::get('/edit/{id}',[SettingController::class,'positionsEdit'])->name('positions.edit');
            Route::put('/update/{id}',[SettingController::class,'positionsUpdate'])->name('positions.update');
            Route::get('/delete/{id}',[SettingController::class,'positionsDelete'])->name('positions.delete');
            Route::get('/filter',[SettingController::class,'positionsFilter'])->name('positions.filter');
        });

        Route::group(['prefix' => 'sources'], function () {
            Route::get('/',[SettingController::class,'sources'])->name('sources.index');
            Route::post('/store',[SettingController::class,'sourcesStore'])->name('sources.store');
            Route::get('/edit/{id}',[SettingController::class,'sourcesEdit'])->name('sources.edit');
            Route::put('/update/{id}',[SettingController::class,'sourcesUpdate'])->name('sources.update');
            Route::get('/delete/{id}',[SettingController::class,'sourcesDelete'])->name('sources.delete');
            Route::get('/filter',[SettingController::class,'sourcesFilter'])->name('sources.filter');
        });

        // contact us
        Route::group(['prefix' => 'contact-us'], function () {
            Route::get('/',[SettingController::class,'contactUs'])->name('contact-us.index');
            Route::get('/filter',[SettingController::class,'contactUsFilter'])->name('contact-us.filter');
        });

        // cms
        Route::group(['prefix' => 'cms'], function () {
            Route::get('/',[SettingController::class,'cms'])->name('cms.index');
            Route::post('/store',[SettingController::class,'cmsStore'])->name('cms.store');
            Route::get('/edit/{id}',[SettingController::class,'cmsEdit'])->name('cms.edit');
            Route::put('/update/{id}',[SettingController::class,'cmsUpdate'])->name('cms.update');
            Route::get('/delete/{id}',[SettingController::class,'cmsDelete'])->name('cms.delete');
            Route::get('/filter',[SettingController::class,'cmsFilter'])->name('cms.filter');
        });
    });

    Route::resources([
        'candidates' => CandidateController::class,
        'companies' => CompanyController::class,
        'jobs' => JobsController::class,
        'schedule-to-do' => ScheduleController::class,
    ]);

    Route::post('/get-job-list',[ScheduleController::class,'getJobList'])->name('get-job-list');
    // schedule-to-do.job-create
    Route::get('/job-create/{id}',[ScheduleController::class,'jobCreate'])->name('schedule-to-do.job-create');


    Route::group(['prefix' => 'company-job'], function () {
        Route::post('/store',[CompanyController::class,'companyJobStore'])->name('company-job.store');
        Route::get('/edit/{id}',[CompanyController::class,'companyJobEdit'])->name('company-job.edit');
        Route::put('/update/{id}',[CompanyController::class,'companyJobUpdate'])->name('company-job.update');
        Route::get('/delete/{id}',[CompanyController::class,'companyJobDelete'])->name('company-job.delete');
        Route::get('/close-job-filter',[CompanyController::class,'closeJobFilter'])->name('company-job.close-job.filter');
        Route::get('/open-job-filter',[CompanyController::class,'openJobFilter'])->name('company-job.open-job.filter');
        Route::post('/get-city',[CompanyController::class,'getCity'])->name('company-job.get-city');
    });


    Route::get('/candidates-auto-fill',[CandidateController::class,'userAutoFill'])->name('candidates.auto-fill');
    Route::get('/candidates-filter',[CandidateController::class,'candidateFilter'])->name('candidates.filter');
    Route::get('/candidates-export', [CandidateController::class, 'export'])->name('candidates.export'); // search export
    Route::post('/candidates-import', [CandidateController::class, 'import'])->name('candidates.import');
    Route::get('/candidates-download-sample', [CandidateController::class, 'downloadSample'])->name('candidates.download.sample');
    Route::get('/candidates-permission/{candidate_id}/{candidate_field_update_id}',[CandidateController::class,'candidatePermission'])->name('candidates.permission');
    Route::get('/candidates-activity/{id}',[CandidateController::class,'candidatesActivity'])->name('candidates.activity');
    Route::post('/candidates-isCalled',[CandidateController::class,'isCalled'])->name('candidates.iscalled.update');
    Route::get('/bulk-status-update',[CandidateController::class,'bulkStatusUpdate'])->name('candidates.bulk.status.update');
    Route::get('/candidates-check-email',[CandidateController::class,'checkEmail'])->name('candidates.check-email');

    Route::get('/companies-filter',[CompanyController::class,'companiesFilter'])->name('companies.filter');
});
