<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CandidateStatusController;
use App\Http\Controllers\ReferralPointController;
use App\Http\Controllers\ReferCmsController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ReportController;
use App\Models\Cms;
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

Route::get('/download-pdf/{id}', [PDFController::class, 'downloadPdf'])->name('download.pdf');

Route::get('/', [AuthenticationController::class, 'login'])->name('login');

Route::post('/login-check', [AuthenticationController::class, 'loginCheck'])->name('login.check');


Route::post('forget-password', [AuthenticationController::class, 'forgetPassword'])->name('forget.password');
Route::get('forget-password/show', [AuthenticationController::class, 'forgetPasswordShow'])->name('forget.password.show');
Route::get('reset-password/{id}/{token}', [AuthenticationController::class, 'resetPassword'])->name('reset.password');

Route::group(['middleware' => ['user', 'preventBackHistory', 'ip-permission']], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::post('/interview-chart', [DashboardController::class, 'interviewChart'])->name('interview.chart-yearly');
    Route::post('/installment-chart', [DashboardController::class, 'installmentChart'])->name('installment.pie-chart');
    Route::get('report/job-interview/ajax', [DashboardController::class, 'getInterviewReportData'])->name('report.job-interview.ajax');
    Route::get('dashboard/job/medical-report/filter', [DashboardController::class, 'filterMedicalReport'])->name('dashboard.job.medical.report.filter');


    Route::post('/get-interview-list', [DashboardController::class, 'getInterviewList'])->name('interview.list');
    Route::get('/report-job-interview', [DashboardController::class, 'reportJobInterview'])->name('report.job-interview.export');
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('change.password');
    Route::post('/profile-update', [ProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::post('/password-update', [ProfileController::class, 'passwordUpdate'])->name('password.update');

    // Setting
    Route::group(['prefix' => 'setting'], function () {
        Route::get('/social-media', [SettingController::class, 'socialMedia'])->name('social-media');
        Route::get('/support', [SettingController::class, 'support'])->name('support');

        // members
        Route::group(['prefix' => 'members'], function () {
            Route::get('/', [SettingController::class, 'members'])->name('members.index');
            Route::post('/store', [SettingController::class, 'membersStore'])->name('members.store');
            Route::get('/edit/{id}', [SettingController::class, 'membersEdit'])->name('members.edit');
            Route::put('/update/{id}', [SettingController::class, 'membersUpdate'])->name('members.update');
            Route::get('/delete/{id}', [SettingController::class, 'membersDelete'])->name('members.delete');
            Route::get('/filter', [SettingController::class, 'memberFilter'])->name('members.filter');
        });
        // members.status
        Route::get('/members-status', [SettingController::class, 'membersStatus'])->name('members.status');
        // user-access
        Route::group(['prefix' => 'user-access'], function () {
            Route::get('/', [SettingController::class, 'userAccess'])->name('user-access.index');
            Route::post('/store', [SettingController::class, 'userAccessStore'])->name('user-access.store');
            Route::get('/edit/{id}', [SettingController::class, 'userAccessEdit'])->name('user-access.edit');
            Route::put('/update/{id}', [SettingController::class, 'userAccessUpdate'])->name('user-access.update');
            Route::get('/delete/{id}', [SettingController::class, 'userAccessDelete'])->name('user-access.delete');
        });

        //status
        Route::group(['prefix' => 'status'], function () {
            Route::get('/', [CandidateStatusController::class, 'index'])->name('status.index');
            Route::get('/edit/{id}', [CandidateStatusController::class, 'statusEdit'])->name('status.edit');
            Route::put('/update/{id}', [CandidateStatusController::class, 'statusUpdate'])->name('status.update');
            Route::get('/delete/{id}', [CandidateStatusController::class, 'statusDelete'])->name('status.delete');
            Route::get('/filter', [CandidateStatusController::class, 'statusFilter'])->name('status.filter');
        });


        // positions
        Route::group(['prefix' => 'positions'], function () {
            Route::get('/', [SettingController::class, 'positions'])->name('positions.index');
            Route::post('/store', [SettingController::class, 'positionsStore'])->name('positions.store');
            Route::get('/edit/{id}', [SettingController::class, 'positionsEdit'])->name('positions.edit');
            Route::put('/update/{id}', [SettingController::class, 'positionsUpdate'])->name('positions.update');
            Route::get('/delete/{id}', [SettingController::class, 'positionsDelete'])->name('positions.delete');
            Route::get('/filter', [SettingController::class, 'positionsFilter'])->name('positions.filter');
        });

        // ip restrictions
        Route::group(['prefix' => 'ip-restrictions'], function () {
            Route::get('/', [SettingController::class, 'ipRestrictions'])->name('ip-restrictions.index');
            Route::post('/store', [SettingController::class, 'ipRestrictionsStore'])->name('ip-restrictions.store');
            Route::get('/edit/{id}', [SettingController::class, 'ipRestrictionsEdit'])->name('ip-restrictions.edit');
            Route::put('/update/{id}', [SettingController::class, 'ipRestrictionsUpdate'])->name('ip-restrictions.update');
            Route::get('/delete/{id}', [SettingController::class, 'ipRestrictionsDelete'])->name('ip-restrictions.delete');
            Route::get('/filter', [SettingController::class, 'ipRestrictionsFilter'])->name('ip-restrictions.filter');
        });

        Route::group(['prefix' => 'sources'], function () {
            Route::get('/', [SettingController::class, 'sources'])->name('sources.index');
            Route::post('/store', [SettingController::class, 'sourcesStore'])->name('sources.store');
            Route::get('/edit/{id}', [SettingController::class, 'sourcesEdit'])->name('sources.edit');
            Route::put('/update/{id}', [SettingController::class, 'sourcesUpdate'])->name('sources.update');
            Route::get('/delete/{id}', [SettingController::class, 'sourcesDelete'])->name('sources.delete');
            Route::get('/filter', [SettingController::class, 'sourcesFilter'])->name('sources.filter');
        });

        // cities
        Route::group(['prefix' => 'cities'], function () {
            Route::get('/', [SettingController::class, 'cities'])->name('cities.index');
            Route::post('/store', [SettingController::class, 'citiesStore'])->name('cities.store');
            Route::get('/edit/{id}', [SettingController::class, 'citiesEdit'])->name('cities.edit');
            Route::put('/update/{id}', [SettingController::class, 'citiesUpdate'])->name('cities.update');
            Route::get('/delete/{id}', [SettingController::class, 'citiesDelete'])->name('cities.delete');
            Route::get('/filter', [SettingController::class, 'citiesFilter'])->name('cities.filter');
        });

         Route::group(['prefix' => 'states'], function () {
            Route::get('/', [SettingController::class, 'states'])->name('states.index');
            Route::post('/store', [SettingController::class, 'statesStore'])->name('states.store');
            Route::get('/edit/{id}', [SettingController::class, 'statesEdit'])->name('states.edit');
            Route::put('/update/{id}', [SettingController::class, 'statesUpdate'])->name('states.update');
            Route::get('/delete/{id}', [SettingController::class, 'statesDelete'])->name('states.delete');
            Route::get('/filter', [SettingController::class, 'statesFilter'])->name('states.filter');
        });

        // contact us
        Route::group(['prefix' => 'contact-us'], function () {
            Route::get('/', [SettingController::class, 'contactUs'])->name('contact-us.index');
            Route::get('/filter', [SettingController::class, 'contactUsFilter'])->name('contact-us.filter');
        });

        // cms
        Route::group(['prefix' => 'cms'], function () {
            Route::get('/', [SettingController::class, 'cms'])->name('cms.index');
            Route::post('/store', [SettingController::class, 'cmsStore'])->name('cms.store');
            Route::get('/edit/{id}', [SettingController::class, 'cmsEdit'])->name('cms.edit');
            Route::put('/update/{id}', [SettingController::class, 'cmsUpdate'])->name('cms.update');
            Route::get('/delete/{id}', [SettingController::class, 'cmsDelete'])->name('cms.delete');
            Route::get('/filter', [SettingController::class, 'cmsFilter'])->name('cms.filter');
        });
    });

    Route::resources([
        'candidates' => CandidateController::class,
        'companies' => CompanyController::class,
        'jobs' => JobsController::class,
        'schedule-to-do' => ScheduleController::class,
        'feeds' => FeedController::class,
        'referral-points' => ReferralPointController::class,
    ]);


    //get city name
    Route::post('/get-city-name', [CandidateController::class, 'getCityName'])->name('candidates.get-city');
    // download-cv
    Route::get('/download-cv/{id}', [CandidateController::class, 'downloadCv'])->name('candidates.download-cv');

    //referral points filter
    Route::get('/referral-points-filter', [ReferralPointController::class, 'referralPointFilter'])->name('referral-points.filter');
    Route::get('/referral-points-delete/{id}', [ReferralPointController::class, 'referralPointDelete'])->name('referral-points.delete'); // search export

    // feeds filter
    Route::get('/feeds-filter', [FeedController::class, 'feedFilter'])->name('feeds.filter');
    Route::get('/feeds-delete/{id}', [FeedController::class, 'feedDelete'])->name('feeds.delete');
    Route::get('/feeds-delete-image', [FeedController::class, 'deleteImage'])->name('feeds.deleteImage');

    Route::post('/get-job-list', [ScheduleController::class, 'getJobList'])->name('get-job-list');
    // schedule-to-do.job-create
    Route::get('/job-create/{id}', [ScheduleController::class, 'jobCreate'])->name('schedule-to-do.job-create');
    Route::get('/schedule-to-do-filter', [ScheduleController::class, 'filter'])->name('schedule-to-do.filter');

    Route::group(['prefix' => 'company-job'], function () {
        Route::post('/store', [CompanyController::class, 'companyJobStore'])->name('company-job.store');
        Route::get('/edit/{id}', [CompanyController::class, 'companyJobEdit'])->name('company-job.edit');
        Route::put('/update/{id}', [CompanyController::class, 'companyJobUpdate'])->name('company-job.update');
        Route::get('/delete/{id}', [CompanyController::class, 'companyJobDelete'])->name('company-job.delete');
        Route::get('/close-job-filter', [CompanyController::class, 'closeJobFilter'])->name('company-job.close-job.filter');
        Route::get('/open-job-filter', [CompanyController::class, 'openJobFilter'])->name('company-job.open-job.filter');
        Route::post('/get-city', [CompanyController::class, 'getCity'])->name('company-job.get-city');
        Route::get('/company-job-download-sample', [CompanyController::class, 'downloadSample'])->name('company-job.download.sample');
        Route::post('/company-job-import', [CompanyController::class, 'import'])->name('company-job.import');
    });
    Route::post('/validate-step/{step}', [CompanyController::class, 'validateStep']);


    Route::get('/candidates-auto-fill', [CandidateController::class, 'userAutoFill'])->name('candidates.auto-fill');
    Route::get('/candidates-filter', [CandidateController::class, 'candidateFilter'])->name('candidates.filter');
    Route::post('/candidates-export', [CandidateController::class, 'export'])->name('candidates.export'); // search export
    Route::post('/candidates-import', [CandidateController::class, 'import'])->name('candidates.import');
    Route::get('/candidates-download-sample', [CandidateController::class, 'downloadSample'])->name('candidates.download.sample');
    Route::get('/candidates-permission/{candidate_id}/{candidate_field_update_id}', [CandidateController::class, 'candidatePermission'])->name('candidates.permission');
    Route::get('/candidates-activity/{id}', [CandidateController::class, 'candidatesActivity'])->name('candidates.activity');
    Route::post('/candidates-isCalled', [CandidateController::class, 'isCalled'])->name('candidates.iscalled.update');
    Route::get('/bulk-status-update', [CandidateController::class, 'bulkStatusUpdate'])->name('candidates.bulk.status.update');
    Route::get('/candidates-check-email', [CandidateController::class, 'checkEmail'])->name('candidates.check-email');
    Route::get('/check-position', [CandidateController::class, 'checkPosition'])->name('candidates.check-position');
    Route::get('/get-jobs', [CandidateController::class, 'getJobs'])->name('candidates.getJobs');
    // candidates.assign-job
    Route::put('/assign-job/{id}', [CandidateController::class, 'assignJob'])->name('candidates.assign-job');
    Route::post('/send-candidate-sms', [CandidateController::class, 'sendSms'])->name('candidates.send-sms');
    Route::post('/send-candidate-whatsapp', [CandidateController::class, 'sendWhatsapp'])->name('candidates.send-whatsapp');
    Route::post('/update-candidate-contact-number', [CandidateController::class, 'updateCandidateContactNumber'])->name('candidates.update-candidate-contact-number');


    Route::get('/companies-filter', [CompanyController::class, 'companiesFilter'])->name('companies.filter');
    Route::get('/companies-change-status', [CompanyController::class, 'changeStatus'])->name('companies.change-status');



    //candidates job routes
    Route::get('/jobs-bulk-status-update', [JobsController::class, 'bulkStatusUpdate'])->name('jobs.bulk.status.update');
    Route::get('/jobs-filter', [JobsController::class, 'candidatejobFilter'])->name('candidates-jobs.filter');
    Route::put('/jobs-candidate-details/{id}', [JobsController::class, 'candidateDetailsUpdate'])->name('jobs.candidate-details.update');
    Route::put('/jobs-details-update/{id}', [JobsController::class, 'candidateJobDetailsUpdate'])->name('jobs.job-details.update');
    Route::put('/jobs-family-details/{id}', [JobsController::class, 'candidateFamilyDetailsUpdate'])->name('jobs.family-details.update');
    Route::put('/jobs-medical-details/{id}', [JobsController::class, 'candidateMedicalDetailsUpdate'])->name('jobs.medical-details.update');
    Route::put('/jobs-visa-details/{id}', [JobsController::class, 'candidateVisaDetailsUpdate'])->name('jobs.visa-details.update');
    Route::put('/jobs-ticket-details/{id}', [JobsController::class, 'candidateTicketDetailsUpdate'])->name('jobs.ticket-details.update');
    Route::put('/jobs-payment-details/{id}', [JobsController::class, 'candidatePaymentDetailsUpdate'])->name('jobs.payment-details.update');
    // jobs.change-status

    // jobs.document-details.update
    Route::put('/jobs-document-details/{id}', [JobsController::class, 'candidateDocumentDetailsUpdate'])->name('jobs.document-details.update');
    Route::post('/send-job-sms', [JobsController::class, 'sendJobSms'])->name('jobs.send-job-sms');
    Route::post('/send-job-whatsapp', [JobsController::class, 'sendJobWhatsapp'])->name('jobs.send-job-whatsapp');

    Route::post('/candidates-job-export', [JobsController::class, 'export'])->name('jobs.export'); // search export

    // jobs.download.sample
    Route::get('/jobs-download-sample', [JobsController::class, 'downloadSample'])->name('jobs.download.sample');
    Route::post('/jobs-import', [JobsController::class, 'import'])->name('jobs.import');

    //referral cms routes
    Route::get('/referral-cms', [ReferCmsController::class, 'referCmsView'])->name('referral-cms.edit');
    Route::post('/jobs-details-update', [ReferCmsController::class, 'referCmsUpdate'])->name('referral-cms.update');

    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/candidate-interview', [ReportController::class, 'candidateInterview'])->name('candidate-interview');
        Route::post('/candidate-interview-export', [ReportController::class, 'candidateInterviewExport'])->name('candidate-interview-export');
        Route::get('/get-candidates', [ReportController::class, 'getCandidates'])->name('get-candidates');
    });
});


Route::get('/terms-and-conditions', [SettingController::class, 'page']);
Route::get('/privacy-policy', [SettingController::class, 'page']);
