<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PersonalDataController;

use App\Http\Controllers\OtherDataController;
use App\Http\Controllers\AddressDataController;
use App\Http\Controllers\EmploymentDataController;

use App\Http\Controllers\PermitController;
use App\Http\Controllers\PermitTemplateController;
use App\Http\Controllers\PermitFeesController;


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

    ##Inhabitants
    Route::get('inhabitants/personal', [PersonalDataController::class, 'getPersonalData']);
    Route::post('inhabitants/personal/store', [PersonalDataController::class, 'store']);

    Route::get('inhabitants/other', [OtherDataController::class, 'getOtherData']);
    Route::post('inhabitants/other/store', [OtherDataController::class, 'store']);

    Route::get('inhabitants/address', [AddressDataController::class, 'getAddressData']);
    Route::post('inhabitants/address/store', [AddressDataController::class, 'store']);

    Route::get('inhabitants/employment', [EmploymentDataController::class, 'getEmploymentData']);
    Route::post('inhabitants/employment/store', [EmploymentDataController::class, 'store']);

    ##Permit
    Route::post('permit/type', [PermitController::class, 'savePermitType']);
    Route::get('permit/type', [PermitController::class, 'getPermitList']);
    Route::post('generatePermit', [PermitController::class, 'generatePermit']);

    Route::post('permit/template', [PermitTemplateController::class, 'savePermitTemplate']);
    Route::get('permit/template', [PermitTemplateController::class, 'getTemplate']);

    Route::post('permit/fees', [PermitFeesController::class, 'store']);
    Route::post('permit/fees/{id}/update', [PermitFeesController::class,'update']);
    Route::get('permit/fees/{id}/edit', [PermitFeesController::class, 'edit']);
});


##Others
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

Route::get('radioaddresstype', [AddressDataController::class, 'getRadioAddressType']);
Route::get('radiotemporarytype', [AddressDataController::class, 'getRadioTemporaryType']);

