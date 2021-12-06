<?php

namespace App\Http\Controllers;

use Hash;
use Helpers;
use Session;
use Validator;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\PersonalData;

class InhabitantController extends Controller
{
    public function savePersonalData(Request $request) {
        $validator = Validator::make($request->all(), [
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'gender' => 'required',
            'marital_status_id' => 'required',
            'religious_id' => 'required',
            'nationality' => 'required',
            'nationality_id' => 'required',
            'birth_date' => 'required',
            'birth_place' => 'required',
            'contact_no' => 'required|digits:10',
            'email' => 'required|string|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()
            ], 400);
        }

        $user = $request->user();
        $resident = 5;
        $personalData = $user->personalData;

        if (empty($personalData)) {
            $personalData = new PersonalData;
            $personalData->user_id = $user->id;
            $user->user_type_id = $resident;
            $user->save();
        }

        $personalData->last_name = $request->last_name;
        $personalData->first_name = $request->first_name;
        $personalData->middle_name = $request->middle_name;
        $personalData->gender = $request->gender;
        $personalData->marital_status_id = $request->marital_status_id;
        $personalData->religious_id = $request->religious_id;
        $personalData->nationality = $request->nationality;
        $personalData->nationality_id = $request->nationality_id;
        $personalData->birth_date = $request->birth_date;
        $personalData->birth_place = $request->birth_place;
        $personalData->contact_no = $request->contact_no;
        $personalData->email = $request->email;
        $personalData->save();

        return response()->json([
            'message' => 'Record has been saved.'
        ], 201);
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

    public function getNationalityList(Request $request) {
        return response()->json(Helpers::getNationalityList());
    }
}
