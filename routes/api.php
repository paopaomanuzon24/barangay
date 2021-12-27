<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\InhabitantsController;
use App\Http\Controllers\PersonalDataController;
use App\Http\Controllers\OtherDataController;
use App\Http\Controllers\AddressDataController;
use App\Http\Controllers\EmploymentDataController;
use App\Http\Controllers\EducationalDataController;
use App\Http\Controllers\FamilyDataController;
use App\Http\Controllers\ResidenceApplicationController;
use App\Http\Controllers\DocumentDataController;
use App\Http\Controllers\GroupsAndAffiliationController;
use App\Http\Controllers\MedicalHistoryController;
use App\Http\Controllers\HouseHoldController;

use App\Http\Controllers\PermitTypeController;
use App\Http\Controllers\PermitTemplateController;
use App\Http\Controllers\PermitFeesController;
use App\Http\Controllers\BarangayOfficialController;
use App\Http\Controllers\PermitCategoryController;
use App\Http\Controllers\PermitGenerationController;



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
    Route::get('user/{id}', [AuthController::class, 'show']);
    Route::get('user/list', [AuthController::class, 'list']);
    Route::post('password', [AuthController::class, 'changePassword']);

    ##Inhabitants
    Route::get('inhabitants/list', [InhabitantsController::class, 'getInhabitantsList']);
    Route::get('inhabitants/{id}', [InhabitantsController::class, 'show']);

    Route::get('inhabitants/personal/{id}', [PersonalDataController::class, 'getPersonalData']);
    Route::get('inhabitants/personal/picture/{id}', [PersonalDataController::class, 'getProfile']);
    Route::post('inhabitants/personal/store', [PersonalDataController::class, 'store']);
    Route::post('inhabitants/personal/picture/store', [PersonalDataController::class, 'profile']);

    Route::get('inhabitants/other/{id}', [OtherDataController::class, 'getOtherData']);
    Route::post('inhabitants/other/store', [OtherDataController::class, 'store']);

    Route::get('inhabitants/address/{id}', [AddressDataController::class, 'getAddressData']);
    Route::post('inhabitants/address/store', [AddressDataController::class, 'store']);

    Route::get('inhabitants/employment/{id}', [EmploymentDataController::class, 'getEmploymentData']);
    Route::post('inhabitants/employment/store', [EmploymentDataController::class, 'store']);

    Route::get('inhabitants/educational/{id}', [EducationalDataController::class, 'getEducationalData']);
    Route::post('inhabitants/educational/store', [EducationalDataController::class, 'store']);

    Route::get('inhabitants/family/{id}', [FamilyDataController::class, 'getFamilyData']);
    Route::post('inhabitants/family/store', [FamilyDataController::class, 'store']);

    Route::post('inhabitants/application/update', [ResidenceApplicationController::class, 'update']);

    Route::get('inhabitants/document/{id}', [DocumentDataController::class, 'getDocumentData']);
    Route::post('inhabitants/document/store', [DocumentDataController::class, 'store']);

    Route::get('inhabitants/groups/{id}', [GroupsAndAffiliationController::class, 'getGroupsAndAffiliationData']);
    Route::post('inhabitants/groups/store', [GroupsAndAffiliationController::class, 'store']);

    Route::get('inhabitants/medical-history/{id}', [MedicalHistoryController::class, 'getMedicalHistory']);
    Route::post('inhabitants/medical-history/store', [MedicalHistoryController::class, 'store']);

    Route::get('inhabitants/house-hold/{id}', [HouseHoldController::class, 'getHouseHold']);
    Route::post('inhabitants/house-hold/store', [HouseHoldController::class, 'store']);

    ##Permit
    Route::post('permit/type', [PermitTypeController::class, 'store']);
    Route::get('permit/type/{id}/edit', [PermitTypeController::class, 'edit']);
    Route::post('permit/type/update', [PermitTypeController::class,'update']);
    Route::post('permit/type/delete', [PermitTypeController::class,'delete']);
    Route::get('permit/types', [PermitTypeController::class, 'list']);
    Route::get('permit/type/{id}', [PermitTypeController::class, 'getPermitType']);


    Route::post('permit/template', [PermitTemplateController::class, 'store']);
    Route::get('permit/template', [PermitTemplateController::class, 'show']);


    Route::post('permit/fee', [PermitFeesController::class, 'store']);
    Route::get('permit/fees/{id}', [PermitFeesController::class, 'show']);
    Route::get('permit/fees/{id}/edit', [PermitFeesController::class, 'edit']);
    Route::post('permit/fees/update', [PermitFeesController::class,'update']);
    Route::post('permit/fees/delete', [PermitFeesController::class,'delete']);
    Route::get('permit/fees', [PermitFeesController::class,'list']);


    Route::post('barangay/officials', [BarangayOfficialController::class, 'store']);
    Route::get('barangay/officials/{id}', [BarangayOfficialController::class, 'show']);
    Route::get('barangay/officials/{id}/edit', [BarangayOfficialController::class, 'edit']);
    Route::post('barangay/officials/update', [BarangayOfficialController::class, 'update']);
    Route::post('barangay/officials/delete', [BarangayOfficialController::class, 'delete']);
    Route::get('barangay/officials', [BarangayOfficialController::class, 'list']);

    Route::post('permit/category', [PermitCategoryController::class, 'store']);
    Route::get('permit/category/{id}', [PermitCategoryController::class, 'show']);
    Route::get('permit/category/{id}/edit', [PermitCategoryController::class, 'edit']);
    Route::post('permit/category/update', [PermitCategoryController::class, 'update']);
    Route::post('permit/category/delete', [PermitCategoryController::class, 'delete']);
    Route::get('permit/categories', [PermitCategoryController::class, 'list']);

    Route::post('permit/generate', [PermitGenerationController::class, 'generatePermit']);


});


##Others
Route::get('barangay/list', [AuthController::class, 'getBarangayList']);
Route::get('user-type/list', [AuthController::class, 'getUserTypeList']);

Route::get('radio/citizenship/list', [PersonalDataController::class, 'getRadioCitizen']);
Route::get('gender/list', [PersonalDataController::class, 'getRadioGender']);
Route::get('marital-status/list', [PersonalDataController::class, 'getMaritalStatusList']);
Route::get('religious/list', [PersonalDataController::class, 'getReligiousList']);
Route::get('citizenship/list', [PersonalDataController::class, 'getCitizenshipList']);
Route::get('residence-status/list', [PersonalDataController::class, 'getResidenceStatusList']);

Route::get('ethnicity/list', [OtherDataController::class, 'getEthnicityList']);
Route::get('language/list', [OtherDataController::class, 'getLanguageList']);
Route::get('disability/list', [OtherDataController::class, 'getDisabilityList']);

Route::get('radio/address-type/list', [AddressDataController::class, 'getRadioAddressType']);
Route::get('radio/temporary-type/list', [AddressDataController::class, 'getRadioTemporaryType']);

Route::get('usual-occupation/list', [EmploymentDataController::class, 'getUsualOccupationList']);
Route::get('class-worker/list', [EmploymentDataController::class, 'getClassWorkerList']);
Route::get('work-affiliation/list', [EmploymentDataController::class, 'getWorkAffiliationList']);
Route::get('radio/place-work-type/list', [EmploymentDataController::class, 'getPlaceWorkType']);

Route::get('education-level/list', [EducationalDataController::class, 'getEducationLevel']);
Route::get('course/list', [EducationalDataController::class, 'getCourseList']);

Route::get('relationship/list', [FamilyDataController::class, 'getRelationshipTypeList']);

Route::get('document/list', [DocumentDataController::class, 'getDocumentFileList']);

Route::get('groups-and-affiliation/list', [GroupsAndAffiliationController::class, 'getGroupsAndAffiliationList']);

Route::get('alcohol-status/list', [MedicalHistoryController::class, 'getAlcoholStatus']);

Route::get('water-source/list', [HouseHoldController::class, 'getWaterSourceList']);
Route::get('land-ownership/list', [HouseHoldController::class, 'getLandOwnershipList']);
Route::get('conveniences-devices/list', [HouseHoldController::class, 'getPresenceList']);
Route::get('radio/residence-type/list', [HouseHoldController::class, 'getRadioResidenceType']);
Route::get('checkbox/internet-access/list', [HouseHoldController::class, 'getInternetAccess']);

