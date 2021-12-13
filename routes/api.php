<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\PersonalDataController;
use App\Http\Controllers\OtherDataController;
use App\Http\Controllers\AddressDataController;
use App\Http\Controllers\EmploymentDataController;
use App\Http\Controllers\EducationalDataController;
use App\Http\Controllers\FamilyDataController;
use App\Http\Controllers\ResidenceApplicationController;

use App\Http\Controllers\PermitController;
use App\Http\Controllers\PermitTemplateController;
use App\Http\Controllers\PermitFeesController;
use App\Http\Controllers\BarangayOfficialController;



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
    Route::get('user/list', [AuthController::class, 'list']);

    ##Inhabitants
    Route::get('inhabitants/personal', [PersonalDataController::class, 'getPersonalData']);
    Route::get('inhabitants/personal/list', [PersonalDataController::class, 'list']);
    Route::post('inhabitants/personal/store', [PersonalDataController::class, 'store']);

    Route::get('inhabitants/other', [OtherDataController::class, 'getOtherData']);
    Route::post('inhabitants/other/store', [OtherDataController::class, 'store']);

    Route::get('inhabitants/address', [AddressDataController::class, 'getAddressData']);
    Route::post('inhabitants/address/store', [AddressDataController::class, 'store']);

    Route::get('inhabitants/employment', [EmploymentDataController::class, 'getEmploymentData']);
    Route::post('inhabitants/employment/store', [EmploymentDataController::class, 'store']);

    Route::get('inhabitants/educational', [EducationalDataController::class, 'getEducationalData']);
    Route::post('inhabitants/educational/store', [EducationalDataController::class, 'store']);

    Route::get('inhabitants/family', [FamilyDataController::class, 'getFamilyData']);
    Route::post('inhabitants/family/store', [FamilyDataController::class, 'store']);

    Route::post('inhabitants/application/update', [ResidenceApplicationController::class, 'update']);

    ##Permit
    Route::post('permit/type', [PermitController::class, 'store']);
    Route::get('permit/type/{id}/edit', [PermitController::class, 'edit']);
    Route::post('permit/type/update', [PermitController::class,'update']);
    Route::get('permit/type', [PermitController::class, 'getPermitList']);
    Route::get('permit/type/{id}', [PermitController::class, 'getPermitType']);
    Route::post('permit/generate', [PermitController::class, 'generatePermit']);

    Route::post('permit/template', [PermitTemplateController::class, 'store']);
    Route::get('permit/template', [PermitTemplateController::class, 'show']);
    #Route::get('permit/template/{id}/edit', [PermitTemplateController::class, 'edit']);
    #Route::post('permit/template/update', [PermitTemplateController::class, 'update']);

    Route::post('permit/fees', [PermitFeesController::class, 'store']);
    Route::post('permit/fees/update', [PermitFeesController::class,'update']);
    Route::get('permit/fees/{id}/edit', [PermitFeesController::class, 'edit']);

    Route::post('barangay/officials', [BarangayOfficialController::class, 'store']);
    Route::get('barangay/officials/{id}', [BarangayOfficialController::class, 'show']);
    Route::get('barangay/officials{id}/edit', [BarangayOfficialController::class, 'edit']);
    Route::post('barangay/officials/update', [BarangayOfficialController::class, 'update']);


});


##Others
Route::get('barangaylist', [AuthController::class, 'getBarangayList']);
Route::get('usertypelist', [AuthController::class, 'getUserTypeList']);

Route::get('radiocitizenshiplist', [PersonalDataController::class, 'getRadioCitizen']);
Route::get('genderlist', [PersonalDataController::class, 'getRadioGender']);
Route::get('maritalstatuslist', [PersonalDataController::class, 'getMaritalStatusList']);
Route::get('religiouslist', [PersonalDataController::class, 'getReligiousList']);
Route::get('citizenshiplist', [PersonalDataController::class, 'getCitizenshipList']);
Route::get('residencestatuslist', [PersonalDataController::class, 'getResidenceStatusList']);

Route::get('ethnicitylist', [OtherDataController::class, 'getEthnicityList']);
Route::get('languagelist', [OtherDataController::class, 'getLanguageList']);
Route::get('disabilitylist', [OtherDataController::class, 'getDisabilityList']);

Route::get('radioaddresstype', [AddressDataController::class, 'getRadioAddressType']);
Route::get('radiotemporarytype', [AddressDataController::class, 'getRadioTemporaryType']);

Route::get('usualoccupationlist', [EmploymentDataController::class, 'getUsualOccupationList']);
Route::get('classworkerlist', [EmploymentDataController::class, 'getClassWorkerList']);
Route::get('workaffiliationlist', [EmploymentDataController::class, 'getWorkAffiliationList']);
Route::get('placeworktypelist', [EmploymentDataController::class, 'getPlaceWorkType']);

Route::get('educationlevellist', [EducationalDataController::class, 'getEducationLevel']);
Route::get('courselist', [EducationalDataController::class, 'getCourseList']);

Route::get('relationshiplist', [FamilyDataController::class, 'getRelationshipTypeList']);

