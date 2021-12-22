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
            'blood_type' => 'required',
            'disease_id' => 'array',
            'active_medical_condition' => 'array',
            'active_medication' => 'array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()
            ], 400);
        }

        $class = new MedicalHistoryClass;
        $class->saveMedicalHistory($request);

        return response()->json([
            'message' => 'Record has been saved.'
        ], 201);
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
        $medicalHistoryDiseaseData = !empty($medicalHistoryData) ? $medicalHistoryData->medicalHistoryDisease : "";
        $medicalActiveConditionData = !empty($medicalHistoryData) ? $medicalHistoryData->medicalActiveCondition : "";

        return customResponse()
            ->message("Medical history data")
            ->data($userData)
            ->success()
            ->generate();
    }

    public function getAlcoholStatus(Request $request) {
        return customResponse()
            ->message("List of alcohol status")
            ->data(Helpers::getAlcoholStatus())
            ->success()
            ->generate();
    }
}
