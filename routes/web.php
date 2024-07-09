<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. Theseadmin/login
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

  Route::get('/cache/1', function() {
    \Artisan::call('route:cache');
    \Artisan::call('config:cache');
    return 'Cache done';
  });

  Route::get('/cache/2', function() {
    \Artisan::call('cache:clear');
    \Artisan::call('view:clear');
    return 'Cache cleared';
  });

  Route::get('/cache/5', function() {
    \Artisan::call('optimize:clear');
    return 'Optimized';
  });




// ============================   Admin Pannel   ============================ //

  use App\Http\Controllers\Admin\Auth\AuthController as AdminAuth;
  use App\Http\Controllers\Admin\DashboardController;
  use App\Http\Controllers\Admin\AshaWorkerController;
  use App\Http\Controllers\Admin\SprayTeamController;
  use App\Http\Controllers\Admin\ExecutiveController;
  use App\Http\Controllers\Admin\LarvaSurveyController;
  use App\Http\Controllers\Admin\FeverSurveyController;
  use App\Http\Controllers\Admin\BreedingSpotController;
  use App\Http\Controllers\Admin\SprayController;
  use App\Http\Controllers\Admin\RoleController;
  use App\Http\Controllers\Admin\ZoneController;
  use App\Http\Controllers\Admin\DivisionController;
  use App\Http\Controllers\Admin\WardController;
  use App\Http\Controllers\Admin\AdminUserController;
  use App\Http\Controllers\Admin\ReportController;

  Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuth::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuth::class, 'login']);
    Route::group(['middleware' => 'admin_auth'], function () {
      Route::get('/logout', [AdminAuth::class, 'logout'])->name('logout');
      Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
      Route::get('/zone-data', [DashboardController::class, 'zone_data'])->name('zone_data');
      Route::get('/get-divisions', [DashboardController::class, 'get_divisions'])->name('get-divisions');
      Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
      Route::post('/profile', [DashboardController::class, 'profile_update']);
      Route::resource('asha-workers', AshaWorkerController::class);
      Route::resource('spray-team', SprayTeamController::class);
      Route::resource('executive', ExecutiveController::class);
      Route::resource('larva-survey', LarvaSurveyController::class);
      Route::resource('fever-survey', FeverSurveyController::class);
      Route::resource('breeding-spot', BreedingSpotController::class);
      Route::resource('spray', SprayController::class);
      Route::resource('role', RoleController::class);
      Route::resource('zone', ZoneController::class);
      Route::resource('division', DivisionController::class);
      Route::resource('ward', WardController::class);
      Route::resource('report', ReportController::class);
      Route::resource('admin-user', AdminUserController::class);
      Route::get('analysis', [DashboardController::class, 'analysis'])->name('analysis');
      Route::get('analysis/{id}', [DashboardController::class, 'analysis_filter'])->name('analysis_filter');
    });
  });

// ============================   Admin Pannel   ============================ //

// ==========================   Executive Pannel   ========================== //

  use App\Http\Controllers\Executive\Auth\AuthController as ExecutiveAuth;
  use App\Http\Controllers\Executive\DashboardController as ExecutiveDashboard;
  use App\Http\Controllers\Executive\AshaWorkerController as ExecutiveAsha;
  use App\Http\Controllers\Executive\SprayTeamController as ExecutiveSprayTeam;
  use App\Http\Controllers\Executive\LarvaSurveyController as ExecutiveLarva;
  use App\Http\Controllers\Executive\FeverSurveyController as ExecutiveFever;
  use App\Http\Controllers\Executive\BreedingSpotController as ExecutiveBreeding;
  use App\Http\Controllers\Executive\SprayController as ExecutiveSpray;
  use App\Http\Controllers\Executive\ReportController as ExecutiveReportController;

  Route::prefix('executive')->name('executive.')->group(function () {
    Route::get('/login', [ExecutiveAuth::class, 'showLoginForm'])->name('login');
    Route::post('/login', [ExecutiveAuth::class, 'login']);
    Route::group(['middleware' => 'executive_auth'], function () {      
      Route::get('/logout', [ExecutiveAuth::class, 'logout'])->name('logout');
      Route::get('/dashboard', [ExecutiveDashboard::class, 'dashboard'])->name('dashboard');
      Route::get('/get-divisions', [ExecutiveDashboard::class, 'get_divisions'])->name('get-divisions');
      Route::get('/profile', [ExecutiveDashboard::class, 'profile'])->name('profile');
      Route::post('/profile', [ExecutiveDashboard::class, 'profile_update']);
      Route::resource('asha-workers', ExecutiveAsha::class);
      Route::resource('spray-team', ExecutiveSprayTeam::class);
      Route::resource('larva-survey', ExecutiveLarva::class);
      Route::resource('fever-survey', ExecutiveFever::class);
      Route::resource('breeding-spot', ExecutiveBreeding::class);
      Route::resource('spray', ExecutiveSpray::class);
      Route::resource('report', ExecutiveReportController::class);
      Route::get('analysis', [ExecutiveDashboard::class, 'analysis'])->name('analysis');
      Route::get('analysis/{id}', [ExecutiveDashboard::class, 'analysis_filter'])->name('analysis_filter');
    });
  });

// ==========================   Executive Pannel   ========================== //

// =========================   Asha Workers Pannel   ======================== //

  use App\Http\Controllers\AshaWorker\AuthController as AshaAuth;
  use App\Http\Controllers\AshaWorker\DashboardController as AshaWorkerDashboard;
  use App\Http\Controllers\AshaWorker\SurveyController as AshaWorkerSurvey;
  use App\Http\Controllers\AshaWorker\BreedingSpotController as AshaWorkerBreedingSpot;
  use App\Http\Controllers\AshaWorker\LarvaSurveyController as AshaWorkerLarvaSurvey;
  use App\Http\Controllers\AshaWorker\FeverSurveyController as AshaWorkerFeverSurvey;
  Route::get('/sms', [AshaWorkerDashboard::class, 'sms']);
  Route::get('/', [AshaAuth::class, 'showLoginForm'])->name('login');
  Route::name('asha_worker.')->group(function () {
    Route::get('/app-locale', [AshaWorkerDashboard::class, 'app_locale'])->name('app_locale');
    Route::get('/login', [AshaAuth::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AshaAuth::class, 'login']);
    Route::get('/register', [AshaAuth::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AshaAuth::class, 'register']);
    Route::post('/validate_number', [AshaAuth::class, 'validate_number'])->name('validate_number');
    Route::get('/wards-list', [AshaAuth::class, 'wards_list'])->name('wards_list');
    Route::get('/forgot-password', [AshaAuth::class, 'forgotPassword'])->name('forgot_password');
    Route::get('/send-forgot-otp', [AshaAuth::class, 'send_forgot_otp'])->name('send_forgot_otp');
    Route::get('/confirm-otp', [AshaAuth::class, 'confirm_otp'])->name('confirm_otp');
    Route::post('/reset-password', [AshaAuth::class, 'resetPassword'])->name('reset_password');
    Route::group(['middleware' => 'asha_worker_auth'], function () {
      Route::get('/logout', [AshaAuth::class, 'logout'])->name('logout');
      Route::get('/dashboard', [AshaWorkerDashboard::class, 'dashboard'])->name('dashboard');
      Route::get('/survey-list', [AshaWorkerSurvey::class, 'index'])->name('servey_list');
      Route::get('/survey-details/{id}', [AshaWorkerSurvey::class, 'show'])->name('servey_details');
      Route::get('/breeding-spots', [AshaWorkerBreedingSpot::class, 'index'])->name('breeding_spots');
      Route::get('/breeding-spots-details/{id}', [AshaWorkerBreedingSpot::class, 'show'])->name('breeding_spots_details');
      Route::post('/survey-ward', [AshaWorkerLarvaSurvey::class, 'survey_ward'])->name('survey_ward');
      Route::get('/larva-survey', [AshaWorkerLarvaSurvey::class, 'create'])->name('larva_survey.create');
      Route::post('/larva-survey', [AshaWorkerLarvaSurvey::class, 'store'])->name('larva_survey.store');
      Route::get('/fever-survey', [AshaWorkerFeverSurvey::class, 'create'])->name('fever_survey.create');
      Route::post('/fever-survey', [AshaWorkerFeverSurvey::class, 'store'])->name('fever_survey.store');
    });
  });

// =========================   Asha Workers Pannel   ======================== //

// =======================   Field Executive Pannel   ======================= //

  use App\Http\Controllers\Workers\DashboardController as FieldExecutiveDashboard;
  use App\Http\Controllers\Workers\SurveyController as FieldExecutiveSurvey;

  Route::prefix('field-executive')->name('field-executive.')->group(function () {
    Route::group(['middleware' => 'field_executive_auth'], function () {
      Route::get('/logout', [AshaAuth::class, 'logout'])->name('logout');
      Route::get('/dashboard', [FieldExecutiveDashboard::class, 'dashboard'])->name('dashboard');
      Route::get('/manage', [FieldExecutiveDashboard::class, 'manage'])->name('manage');
      Route::get('/servey-list', [FieldExecutiveSurvey::class, 'servey_list'])->name('servey_list');
      Route::get('/servey-details/{id}', [FieldExecutiveSurvey::class, 'servey_details'])->name('servey_details');
      Route::get('/asha-workers', [FieldExecutiveDashboard::class, 'asha_workers'])->name('asha_workers');
      Route::get('/breeding-spots', [FieldExecutiveSurvey::class, 'breeding_spots'])->name('breeding_spots');
      Route::get('/breeding-spots-list', [FieldExecutiveSurvey::class, 'breeding_spots_list'])->name('breeding_spots_list');
      Route::get('/report', [FieldExecutiveDashboard::class, 'report'])->name('report');
      Route::get('/history', [FieldExecutiveDashboard::class, 'history'])->name('history');
      Route::get('/history-details/{id}', [FieldExecutiveDashboard::class, 'history_details'])->name('history_details');
    });
  });

// =======================   Field Executive Pannel   ======================= //

// ==========================   Spray Team Pannel   ========================= //

  use App\Http\Controllers\SprayTeam\AuthController as SprayTeamAuth;
  use App\Http\Controllers\SprayTeam\DashboardController as SprayTeamDashboard;
  use App\Http\Controllers\SprayTeam\TaskController;

  Route::prefix('user')->name('spray_team.')->group(function () {
    Route::get('/login', [SprayTeamAuth::class, 'showLoginForm'])->name('login');
    Route::post('/login', [SprayTeamAuth::class, 'login']);
    Route::group(['middleware' => 'spray_team_auth'], function () {
      Route::get('/logout', [SprayTeamAuth::class, 'logout'])->name('logout');
      Route::get('/dashboard', [SprayTeamDashboard::class, 'dashboard'])->name('dashboard');
      Route::get('/my-task', [TaskController::class, 'index'])->name('task_list');
      Route::get('/my-task-details/{id}', [TaskController::class, 'show'])->name('task_details');
      Route::get('/spray/{id}', [TaskController::class, 'create'])->name('spray_add');
      Route::post('/spray', [TaskController::class, 'store'])->name('spray_store');
      Route::get('/history-list', [SprayTeamDashboard::class, 'index'])->name('history_list');
      Route::get('/history-details/{id}', [SprayTeamDashboard::class, 'show'])->name('history_details');
    });
  });

// ==========================   Spray Team Pannel   ========================= //