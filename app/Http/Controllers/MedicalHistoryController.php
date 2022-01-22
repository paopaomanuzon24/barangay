<?php

namespace App\Http\Controllers;

use Helpers;
use Session;
use Validator;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Classes\MedicalHistoryClass;

use App\Models\MedicalActiveCondition;
use App\Models\User as UserModel;
use App\Models\BloodType;
use App\Models\Vaccine;

class MedicalHistoryController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'height' => 'required',
            'weight' => 'required',
            'blood_type' => 'required'
        ]);

        if ($validator->fails()) {
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $class = new MedicalHistoryClass;
        $class->saveMedicalHistory($request);

        return customResponse()
            ->data(null)
            ->message('Record has been saved.')
            ->success()
            ->generate(); 
    }

    public function getMedicalHistory(Request $request, $id) {
        $userData = UserModel::find($id);
        if (empty($userData)) {
            return customResponse()
                ->message("No data")
                ->data(null)
                ->failed()
                ->generate();
        }

        $medicalHistoryData = $userData->medicalHistory;
        $medicalHistoryDiseaseData = !empty($medicalHistoryData->medicalHistoryDisease) ? $medicalHistoryData->medicalHistoryDisease : "";
        // $medicalActiveConditionData = !empty($medicalHistoryData->medicalActiveCondition) ? $medicalHistoryData->medicalActiveCondition : "";
        $medicalHistoryVaccine = !empty($medicalHistoryData->medicalHistoryVaccine) ? $medicalHistoryData->medicalHistoryVaccine : "";

        return customResponse()
            ->message("Medical history data.")
            ->data($userData)
            ->success()
            ->generate();
    }

    public function saveMedicalCondtion(Request $request) {
        $validator = Validator::make($request->all(), [
            'disease_id' => 'required'
        ]);

        if ($validator->fails()) {
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $class = new MedicalHistoryClass;
        $class->saveMedicalCondtion($request);

        return customResponse()
            ->data(null)
            ->message('Record has been saved.')
            ->success()
            ->generate(); 
    }

    public function destroyMedicalCondtion(Request $request, $id) {
        $medicalActiveData = MedicalActiveCondition::find($id);
        if (!empty($medicalActiveData)) {
            $medicalActiveData->delete();
            return customResponse()
                ->message("Record has been deleted.")
                ->data(null)
                ->success()
                ->generate();
        }

        return customResponse()
            ->message("No data.")
            ->data(null)
            ->failed()
            ->generate();
    }

    public function getActiveMedicalConditionList(Request $request, $id) {
        $medActiveList = MedicalActiveCondition::select(
            "medical_active_condition.id",
            "medical_active_condition.user_id",
            "medical_active_condition.disease_id",
            "diseases.description as disease_desc",
            "medical_active_condition.active_medication"
        )
        ->join("diseases", "diseases.id", "medical_active_condition.disease_id")
        ->where("user_id", $id)
        ->get();

        return customResponse()
            ->data($medActiveList)
            ->message('List of medical active condtion.')
            ->success()
            ->generate(); 
    }

    public function getActiveMedicalConditionData(Request $request, $id) {
        $medActiveData = MedicalActiveCondition::select(
            "medical_active_condition.id",
            "medical_active_condition.user_id",
            "medical_active_condition.disease_id",
            "medical_active_condition.active_medication"
        )
        ->find($id);

        return customResponse()
            ->data($medActiveData)
            ->message('Medical active condtion data.')
            ->success()
            ->generate(); 
    }

    public function getAlcoholStatus(Request $request) {
        return customResponse()
            ->message("List of alcohol status.")
            ->data(Helpers::getAlcoholStatus())
            ->success()
            ->generate();
    }

    public function getVaccineList(Request $request) {
        $list = Vaccine::select(
            'id',
            'description'
        )
        ->get();
        
        return customResponse()
            ->message("List of vaccines.")
            ->data($list)
            ->success()
            ->generate();
    }

    public function getBloodTypeList(Request $request) {
        $list = BloodType::select(
            'id',
            'description'
        )
        ->get();
        
        return customResponse()
            ->message("List of blood type.")
            ->data($list)
            ->success()
            ->generate();
    }
}
