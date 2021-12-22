<?php

namespace App\Http\Controllers;

use Helpers;
use Session;
use Validator;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\PersonalData;

class InhabitantsController extends Controller
{
    public function getInhabitantsList(Request $request) {
        $resident = 5;
        $peronalDataList = PersonalData::select(
            'personal_data.id',
            'personal_data.user_id',
            'personal_data.resident_id',
            'personal_data.first_name',
            'personal_data.middle_name',
            'personal_data.last_name',
            'users.barangay_id',
            'personal_data.birth_date'
        )
        ->join("users", "users.id", "personal_data.user_id")
        ->where("users.user_type_id", $resident);

        if ($request->search) {
            $peronalDataList = $peronalDataList->where(function($q) use($request){
                $q->orWhereRaw("personal_data.resident_id LIKE ?","%".$request->search."%");
                $q->orWhereRaw("CONCAT_WS(' ',CONCAT(personal_data.last_name,','),personal_data.first_name,personal_data.first_name) LIKE ?","%".$request->search."%");
            });
        }

        if ($request->barangay_id) {
            $peronalDataList = $peronalDataList->where("users.barangay_id", $request->barangay_id);
        }

        $peronalDataList = $peronalDataList->get();
        
        return customResponse()
            ->message("List of residence")
            ->data($peronalDataList)
            ->success()
            ->generate();
    }
    
    public function show(Request $request, $id) {
        $personalData = PersonalData::find($id);
        $userData = !empty($personalData->userData) ? $personalData->userData : "";
        if (!empty($userData)) {
            $profilePicture = $userData->profilePicture;
            $personalData = $userData->personalData;
            $otherData = $userData->otherData;
            $otherDataLanguage = !empty($otherData->language) ? $otherData->language : "";
            $addressData = $userData->addressData;
            $employmentData = $userData->employmentData;
            $educationalData = $userData->educationalData;
            $educationalOtherData = $userData->educationalOtherData;
            $familyData = $userData->familyData;
            $documentData = $userData->documentData;
            $groupsAndAffiliationData = $userData->groupsAndAffiliationData;
            $residenceApplicationStatus = $userData->residenceApplicationStatus;
            $medicalHistoryData = $userData->medicalHistory;
            $medicalHistoryDiseaseData = !empty($medicalHistoryData->medicalHistoryDisease) ? $medicalHistoryData->medicalHistoryDisease : "";
            $medicalActiveConditionData = !empty($medicalHistoryData->medicalActiveCondition) ? $medicalHistoryData->medicalActiveCondition : "";
        }

        return customResponse()
            ->message("Residence user data")
            ->data($userData)
            ->success()
            ->generate();
    }
}
