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

use App\Models\User as UserModel;

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
        $medicalActiveConditionData = !empty($medicalHistoryData->medicalActiveCondition) ? $medicalHistoryData->medicalActiveCondition : "";
        $medicalHistoryVaccine = !empty($medicalHistoryData->medicalHistoryVaccine) ? $medicalHistoryData->medicalHistoryVaccine : "";

        return customResponse()
            ->message("Medical history data.")
            ->data($userData)
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
}
