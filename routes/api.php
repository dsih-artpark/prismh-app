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

Route::any('location/all', 'App\Http\Controllers\Api\ApiController@listlocations');
Route::any('survey/all', 'App\Http\Controllers\Api\ApiController@listsurveys');
Route::any('fever_survey/list', 'App\Http\Controllers\Api\ApiController@fever_servey_list');
Route::any('access_token', 'App\Http\Controllers\Api\ApiController@access_token');
