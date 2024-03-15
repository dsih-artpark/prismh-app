<?php

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


Route::any('otp/store', 'App\Http\Controllers\Home@generate')->name('otp.store');
// Route::any('otp/store', 'App\Http\Controllers\otpC@generate')->name('otp.store');
// Route::post('forgotpasswordstore', 'App\Http\Controllers\Home@forgotpasswordstore')->name('forgot-password.api');
Route::get('approvals/memberstatus/{id}/{row}','App\Http\Controllers\Admin\ApprovalsController@statusapprovals')->name('adminapprovals.memberstatus');
Route::any('location/all', 'App\Http\Controllers\Api\ApiController@listlocations');
Route::any('survey/all', 'App\Http\Controllers\Api\ApiController@listsurveys');
Route::any('fever_survey/list', 'App\Http\Controllers\Api\ApiController@fever_servey_list');
Route::any('access_token', 'App\Http\Controllers\Api\ApiController@access_token');
