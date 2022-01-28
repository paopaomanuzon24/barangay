<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserManagementController;

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
use App\Http\Controllers\HouseKeeperController;

use App\Http\Controllers\PermitTypeController;
use App\Http\Controllers\PermitTemplateController;
use App\Http\Controllers\PermitFeesController;
use App\Http\Controllers\BarangayOfficialController;
use App\Http\Controllers\PermitCategoryController;
use App\Http\Controllers\PermitRequestController;
use App\Http\Controllers\PermitPaymentMethodController;
use App\Http\Controllers\PermitLayoutController;

use App\Http\Controllers\ClearanceTypeController;
use App\Http\Controllers\ClearancePaymentMethodController;
use App\Http\Controllers\ClearanceCategoryController;
use App\Http\Controllers\ClearanceRequestController;






use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\BarangayController;
use App\Http\Controllers\IncidentController;

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

Route::group(['middleware' => ['auth:sanctum', 'usersession', 'cors']], function() {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);
    Route::get('user/list', [AuthController::class, 'list']);
    Route::get('user/{id}', [AuthController::class, 'show']);
    Route::post('password', [AuthController::class, 'changePassword']);

    ##User Management
    Route::get('user-management/{id}', [UserManagementController::class, 'show']);
    Route::post('user-management/store', [UserManagementController::class, 'store']);

    ##Inhabitants
    Route::get('inhabitants/list', [InhabitantsController::class, 'getInhabitantsList']);
    Route::get('inhabitants/residence/list', [InhabitantsController::class, 'getResidenceList']);
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
    Route::get('inhabitants/educational/list/{id}', [EducationalDataController::class, 'list']);
    Route::post('inhabitants/educational/store', [EducationalDataController::class, 'store']);
    Route::post('inhabitants/educational/destroy/{id}', [EducationalDataController::class, 'destroy']);

    Route::get('inhabitants/family/{id}', [FamilyDataController::class, 'getFamilyData']);
    Route::get('inhabitants/family/list/{id}', [FamilyDataController::class, 'list']);
    Route::get('inhabitants/family/user/list/{id}', [FamilyDataController::class, 'userList']);
    Route::post('inhabitants/family/store', [FamilyDataController::class, 'store']);
    Route::post('inhabitants/family/destroy/{id}', [FamilyDataController::class, 'destroy']);

    Route::post('inhabitants/application/update', [ResidenceApplicationController::class, 'update']);

    Route::get('inhabitants/document/{id}', [DocumentDataController::class, 'getDocumentData']);
    Route::get('inhabitants/document/list/{id}', [DocumentDataController::class, 'list']);
    Route::post('inhabitants/document/store', [DocumentDataController::class, 'store']);
    Route::post('inhabitants/document/destroy/{id}', [DocumentDataController::class, 'destroy']);

    Route::get('inhabitants/groups/{id}', [GroupsAndAffiliationController::class, 'getGroupsAndAffiliationData']);
    Route::post('inhabitants/groups/store', [GroupsAndAffiliationController::class, 'store']);

    Route::get('inhabitants/medical-history/{id}', [MedicalHistoryController::class, 'getMedicalHistory']);
    Route::post('inhabitants/medical-history/store', [MedicalHistoryController::class, 'store']);

    Route::get('inhabitants/active-medical-condition/{id}', [MedicalHistoryController::class, 'getActiveMedicalConditionData']);
    Route::get('inhabitants/active-medical-condition/list/{id}', [MedicalHistoryController::class, 'getActiveMedicalConditionList']);
    Route::post('inhabitants/active-medical-condition/store', [MedicalHistoryController::class, 'saveMedicalCondtion']);
    Route::post('inhabitants/active-medical-condition/destroy/{id}', [MedicalHistoryController::class, 'destroyMedicalCondtion']);

    Route::get('inhabitants/house-hold/{id}', [HouseHoldController::class, 'index']);
    Route::post('inhabitants/house-hold/store', [HouseHoldController::class, 'store']);
    Route::get('inhabitants/house-hold-water-source/list', [HouseHoldController::class, 'houseHoldWaterSourceList']);
    Route::post('inhabitants/house-hold-water-source/store', [HouseHoldController::class, 'saveHouseHoldWaterSource']);

    Route::get('inhabitants/house-keeper/{id}', [HouseKeeperController::class, 'getHouseKeeperData']);
    Route::get('inhabitants/house-keeper/list/{id}', [HouseKeeperController::class, 'list']);
    Route::get('inhabitants/house-keeper/user/list/{id}', [HouseKeeperController::class, 'userList']);
    Route::post('inhabitants/house-keeper/store', [HouseKeeperController::class, 'store']);
    Route::post('inhabitants/house-keeper/destroy/{id}', [HouseKeeperController::class, 'destroy']);

    ##Permit
    Route::post('barangay/officials', [BarangayOfficialController::class, 'store']);
    Route::get('barangay/officials/{id}', [BarangayOfficialController::class, 'show']);
    Route::get('barangay/officials/{id}/edit', [BarangayOfficialController::class, 'edit']);
    Route::post('barangay/officials/update', [BarangayOfficialController::class, 'update']);
    Route::post('barangay/officials/delete', [BarangayOfficialController::class, 'delete']);
    Route::get('barangay/officials', [BarangayOfficialController::class, 'list']);



    Route::post('permit/type', [PermitTypeController::class, 'store']);
    Route::get('permit/type/{id}/edit', [PermitTypeController::class, 'edit']);
    Route::post('permit/type/update', [PermitTypeController::class,'update']);
    Route::post('permit/type/delete', [PermitTypeController::class,'delete']);
    Route::get('permit/type/{id}', [PermitTypeController::class, 'getPermitType']);

    Route::get('permit/type/{id}', [PermitTypeController::class, 'show']);
    Route::get('permit/types', [PermitTypeController::class, 'list']);

    Route::post('permit/category', [PermitCategoryController::class, 'store']);
    Route::get('permit/category/{id}', [PermitCategoryController::class, 'show']);
    Route::get('permit/category/{id}/edit', [PermitCategoryController::class, 'edit']);
    Route::post('permit/category/update', [PermitCategoryController::class, 'update']);
    Route::post('permit/category/delete', [PermitCategoryController::class, 'delete']);
    Route::get('permit/categories', [PermitCategoryController::class, 'list']);


   /*  Route::post('permit/fee', [PermitFeesController::class, 'store']);
    Route::get('permit/fees/{id}', [PermitFeesController::class, 'show']);
    Route::get('permit/fees/{id}/edit', [PermitFeesController::class, 'edit']);
    Route::post('permit/fees/update', [PermitFeesController::class,'update']);
    Route::post('permit/fees/delete', [PermitFeesController::class,'delete']);
    Route::get('permit/fees', [PermitFeesController::class,'list']);
 */




    Route::get('permit/paymentmethod/list', [PermitPaymentMethodController::class, 'list']);

    Route::get('permit/request/list', [PermitRequestController::class, 'list']);



    Route::post('permit/payment', [PermitRequestController::class, 'permitPayment']);


    Route::post('permit/admin/request', [PermitRequestController::class, 'generatePermit']);
    Route::post('permit/request/deny', [PermitRequestController::class, 'denyRequest']);


    Route::get('permit/payment/{id}', [PermitRequestController::class, 'getPermitPaymentData']);
    Route::post('permit/request', [PermitRequestController::class, 'generatePermit']);

    Route::post('permit/request/approve', [PermitRequestController::class, 'approveRequest']);
    Route::post('permit/request/layout/update', [PermitLayoutController::class, 'updateRequestLayout']);
    Route::get('permit/request/{id}', [PermitRequestController::class, 'show']);
    Route::get('permit/request/layout/{id}/edit', [PermitLayoutController::class, 'editRequestLayout']);


    Route::post('permit/request/print', [PermitRequestController::class, 'printPermit']);

    #Clearance Category
    Route::post('clearance/category', [ClearanceCategoryController::class, 'store']);
    Route::get('clearance/category/{id}', [ClearanceCategoryController::class, 'show']);
    Route::get('clearance/category/{id}/edit', [ClearanceCategoryController::class, 'edit']);
    Route::post('clearance/category/update', [ClearanceCategoryController::class, 'update']);
    Route::post('clearance/category/delete', [ClearanceCategoryController::class, 'delete']);
    Route::get('clearance/categories', [ClearanceCategoryController::class, 'list']);



    #Clearance Type
    Route::post('clearance/type', [ClearanceTypeController::class, 'store']);
    Route::get('clearance/type/{id}/edit', [ClearanceTypeController::class, 'edit']);
    Route::post('clearance/type/update', [ClearanceTypeController::class,'update']);
    Route::post('clearance/type/delete', [ClearanceTypeController::class,'delete']);
    Route::get('clearance/type/{id}', [ClearanceTypeController::class, 'show']);
    Route::get('clearance/types', [ClearanceTypeController::class, 'list']);


    #Clearance Payment Method
    Route::get('clearance/paymentmethod/list', [ClearancePaymentMethodController::class, 'list']);

    #Clearance Request
    Route::post('clearance/request', [ClearanceRequestController::class, 'requestPermit']);
    Route::post('clearance/admin/request', [ClearanceRequestController::class, 'requestPermit']);
    Route::get('clearance/request/list', [ClearanceRequestController::class, 'list']);
    Route::post('clearance/payment', [ClearanceRequestController::class, 'clearancePayment']);
    Route::get('clearance/request/{id}', [ClearanceRequestController::class, 'show']);
    Route::post('clearance/request/deny', [ClearanceRequestController::class, 'denyRequest']);
    Route::get('clearance/payment/{id}', [ClearanceRequestController::class, 'getClearancePaymentData']);
    Route::post('clearance/request/approve', [ClearanceRequestController::class, 'approveRequest']);
    Route::post('clearance/print', [ClearanceRequestController::class, 'printClearance']);
    Route::post('clearance/printPDF', [ClearanceRequestController::class, 'printClearancePDF']);


    #Report
    #Route::get('report/dashboard/printPDF', [ClearanceRequestController::class, 'printClearancePDF']);

    ##Announcement
    Route::get('announement/list', [AnnouncementController::class, 'index']);
    Route::get('announement/display', [AnnouncementController::class, 'display']);
    Route::get('announement/{id}', [AnnouncementController::class, 'show']);
    Route::post('announement/store', [AnnouncementController::class, 'store']);

    ##Barangay
    Route::post('barangay/print/id', [BarangayController::class, 'printBarangayID']);

    Route::get('incident/admin/list', [IncidentController::class, 'incidentList']);
    Route::get('incident/count', [IncidentController::class, 'countIncident']);
    Route::get('incident/list/{id}', [IncidentController::class, 'list']);
    Route::post('incident/store', [IncidentController::class, 'store']);
    Route::post('incident/mark-as-read/{id}', [IncidentController::class, 'markAsRead']);
    Route::get('incident/show/{id}', [IncidentController::class, 'show']);
    Route::post('incident/destroy/{id}', [IncidentController::class, 'destroy']);
});








#Route::get('permit/request/{id}/edit', [PermitRequestController::class, 'edit']);

#Route::post('permit/request/update', [PermitRequestController::class, 'permitPayment']);






##Others
Route::get('barangay/list', [AuthController::class, 'getBarangayList']);
Route::get('user-type/list', [AuthController::class, 'getUserTypeList']);

Route::get('radio/citizenship/list', [PersonalDataController::class, 'getRadioCitizen']);
Route::get('gender/list', [PersonalDataController::class, 'getRadioGender']);
Route::get('marital-status/list', [PersonalDataController::class, 'getMaritalStatusList']);
Route::get('religious/list', [PersonalDataController::class, 'getReligiousList']);
Route::get('citizenship/list', [PersonalDataController::class, 'getCitizenshipList']);
Route::get('residence-status/list', [PersonalDataController::class, 'getResidenceStatusList']);
Route::get('country/list', [PersonalDataController::class, 'getCountryList']);
Route::get('province/list', [PersonalDataController::class, 'getProvinceList']);
Route::get('municipality/list', [PersonalDataController::class, 'getMunicipalityList']);

Route::get('ethnicity/list', [OtherDataController::class, 'getEthnicityList']);
Route::get('language/list', [OtherDataController::class, 'getLanguageList']);
Route::get('disability/list', [OtherDataController::class, 'getDisabilityList']);
Route::get('community/list', [OtherDataController::class, 'getCommunityList']);

Route::get('radio/address-type/list', [AddressDataController::class, 'getRadioAddressType']);
Route::get('radio/temporary-type/list', [AddressDataController::class, 'getRadioTemporaryType']);

Route::get('employee-type/list', [EmploymentDataController::class, 'getRadioEmployeeType']);
Route::get('usual-occupation/list', [EmploymentDataController::class, 'getUsualOccupationList']);
Route::get('class-worker/list', [EmploymentDataController::class, 'getClassWorkerList']);
Route::get('work-affiliation/list', [EmploymentDataController::class, 'getWorkAffiliationList']);
Route::get('radio/place-work-type/list', [EmploymentDataController::class, 'getPlaceWorkType']);

Route::get('education-level/list', [EducationalDataController::class, 'getEducationLevel']);
Route::get('course/list', [EducationalDataController::class, 'getCourseList']);
Route::get('year-level/list', [EducationalDataController::class, 'getYearLevelList']);

Route::get('relationship/list', [FamilyDataController::class, 'getRelationshipTypeList']);

Route::get('document/list', [DocumentDataController::class, 'getDocumentFileList']);

Route::get('groups-and-affiliation/list', [GroupsAndAffiliationController::class, 'getGroupsAndAffiliationList']);

Route::get('alcohol-status/list', [MedicalHistoryController::class, 'getAlcoholStatus']);
Route::get('vaccine/list', [MedicalHistoryController::class, 'getVaccineList']);
Route::get('blood-type/list', [MedicalHistoryController::class, 'getBloodTypeList']);
Route::get('disease/list', [MedicalHistoryController::class, 'getDiseaseList']);
Route::get('height-type/list', [MedicalHistoryController::class, 'getHeightTypeList']);
Route::get('weight-type/list', [MedicalHistoryController::class, 'getWeightTypeList']);

Route::get('water-source/list', [HouseHoldController::class, 'getWaterSourceList']);
Route::get('land-ownership/list', [HouseHoldController::class, 'getLandOwnershipList']);
Route::get('conveniences-devices/list', [HouseHoldController::class, 'getPresenceList']);
Route::get('radio/residence-type/list', [HouseHoldController::class, 'getRadioResidenceType']);
Route::get('checkbox/internet-access/list', [HouseHoldController::class, 'getInternetAccess']);
Route::get('building-house-type/list', [HouseHoldController::class, 'getBuildingHouseType']);
Route::get('roof-materials/list', [HouseHoldController::class, 'getRoofList']);
Route::get('wall-materials/list', [HouseHoldController::class, 'getWallList']);
Route::get('building-house-repair/list', [HouseHoldController::class, 'getBuildingHouseRepair']);
Route::get('year-built/list', [HouseHoldController::class, 'getYearBuiltList']);
Route::get('floor-area/list', [HouseHoldController::class, 'getFloorArea']);
Route::get('lighting/list', [HouseHoldController::class, 'getLightingList']);
Route::get('cooking/list', [HouseHoldController::class, 'getCookingList']);
Route::get('house-status/list', [HouseHoldController::class, 'getHouseStatusList']);
Route::get('house-acquisition/list', [HouseHoldController::class, 'getHouseAcquisitionList']);
Route::get('house-financing-source/list', [HouseHoldController::class, 'getHouseFinancingSource']);
Route::get('monthly-rental/list', [HouseHoldController::class, 'getMonthlyRental']);
Route::get('lot-status/list', [HouseHoldController::class, 'getLotStatusList']);
Route::get('garbage-disposal/list', [HouseHoldController::class, 'getGarbageDisposal']);
Route::get('toilet-facility/list', [HouseHoldController::class, 'getToiletFacility']);
Route::get('radio/garage-and-parking-status/list', [HouseHoldController::class, 'getGarageAndParkingList']);
Route::get('radio/septic-tank-status/list', [HouseHoldController::class, 'getSepticTankStatusList']);

Route::get('house-keeper-type/list', [HouseKeeperController::class, 'getHouseKeeperType']);


Route::post('permit/template', [PermitTemplateController::class, 'store']);
Route::get('permit/template/{id}', [PermitTemplateController::class, 'show']);
Route::post('permit/template/delete', [PermitTemplateController::class, 'delete']);

Route::get('incident/type/list', [IncidentController::class, 'getIncidentTypeList']);

