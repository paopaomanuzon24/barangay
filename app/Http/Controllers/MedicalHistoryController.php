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

class MedicalHistoryController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'height' => 'required',
            'weight' => 'required',
            'blood_type' => 'required',
            'disease_id' => 'array'
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

    public function getMedicalHistory(Request $request) {
        $userData = $request->user();
        $medicalHistoryData = $request->user()->medicalHistory;
        $medicalHistoryDiseaseData = !empty($medicalHistoryData) ? $medicalHistoryData->medicalHistoryDisease : "";
        return response()->json($userData);
    }

    public function getAlcoholStatus(Request $request) {
        return response()->json(Helpers::getAlcoholStatus());
    }
}
