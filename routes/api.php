<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PersonalDataController;
use App\Http\Controllers\OtherDataController;
use App\Http\Controllers\AddressDataController;


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

    Route::get('inhabitants/personal', [PersonalDataController::class, 'getPersonalData']);
    Route::post('inhabitants/personal/store', [PersonalDataController::class, 'store']);

    Route::get('inhabitants/other', [OtherDataController::class, 'getOtherData']);
    Route::post('inhabitants/other/store', [OtherDataController::class, 'store']);

    Route::post('inhabitants/address/store', [AddressDataController::class, 'store']);
});

Route::get('barangaylist', [AuthController::class, 'getBarangayList']);
Route::get('usertypelist', [AuthController::class, 'getUserTypeList']);

Route::get('radiocitizenshiplist', [PersonalDataController::class, 'getRadioCitizen']);
Route::get('genderlist', [PersonalDataController::class, 'getRadioGender']);
Route::get('maritalstatuslist', [PersonalDataController::class, 'getMaritalStatusList']);
Route::get('religiouslist', [PersonalDataController::class, 'getReligiousList']);
Route::get('citizenshiplist', [PersonalDataController::class, 'getCitizenshipList']);

Route::get('ethnicitylist', [OtherDataController::class, 'getEthnicityList']);
Route::get('languagelist', [OtherDataController::class, 'getLanguageList']);
Route::get('disabilitylist', [OtherDataController::class, 'getDisabilityList']);



