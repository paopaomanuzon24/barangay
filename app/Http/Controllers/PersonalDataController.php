<?php

namespace App\Http\Controllers;

use Helpers;
use Session;
use Validator;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Classes\PersonalDataClass;

class PersonalDataController extends Controller
{
    public function savePersonalData(Request $request) {
        $validator = Validator::make($request->all(), [
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'gender' => 'required',
            'marital_status_id' => 'required',
            'religious_id' => 'required',
            'citizenship' => 'required',
            'birth_date' => 'required',
            'birth_place' => 'required',
            'contact_no' => 'required|digits:10',
            'email' => 'required|string|email|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()
            ], 400);
        }

        $class = new PersonalDataClass;
        $class->savePersonalData($request);

        return response()->json([
            'message' => 'Record has been saved.'
        ], 201);
    }

    public function getPersonalData(Request $request) {
        return response()->json($request->user()->personalData);
    }

    public function getRadioGender(Request $request) {
        return response()->json(Helpers::getRadioGender());
    }

    public function getRadioCitizen(Request $request) {
        return response()->json(Helpers::getRadioCitizen());
    }
    
    public function getMaritalStatusList(Request $request) {
        return response()->json(Helpers::getMaritalStatusList());
    }
    
    public function getReligiousList(Request $request) {
        return response()->json(Helpers::getReligiousList());
    }

    public function getCitizenshipList(Request $request) {
        return response()->json(Helpers::getCitizenshipList());
    }
}
