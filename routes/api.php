<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InhabitantController;


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

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');

 Route::group(['middleware' => ['auth:sanctum', 'usersession']], function() {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);

    Route::post('savepersonaldata', [InhabitantController::class, 'savePersonalData']);
});

Route::get('getbarangaylist', [AuthController::class, 'getBarangayList']);
Route::get('getusertypelist', [AuthController::class, 'getUserTypeList']);

Route::get('getradiocitizen', [InhabitantController::class, 'getRadioCitizen']);
Route::get('getradiogender', [InhabitantController::class, 'getRadioGender']);
Route::get('getmaritalstatus', [InhabitantController::class, 'getMaritalStatusList']);
Route::get('getreligious', [InhabitantController::class, 'getReligiousList']);
Route::get('getnationality', [InhabitantController::class, 'getNationalityList']);



