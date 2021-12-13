<?php

namespace App\Http\Controllers;

use Helpers;
use Session;
use Validator;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Classes\EmploymentDataClass;

class EmploymentDataController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'employment_type' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()
            ], 400);
        }

        $class = new EmploymentDataClass;
        $class->saveEmploymentData($request);

        return response()->json([
            'message' => 'Record has been saved.'
        ], 201);        
    }

    public function getEmploymentData(Request $request) {
        $userData = $request->user();
        $employmentData = $request->user()->employmentData;
        return response()->json($userData); 
    }

    public function getClassWorkerList(Request $request) {
        return response()->json(Helpers::getClassWorkerList()); 
    }

    public function getUsualOccupationList(Request $request) {
        return response()->json(Helpers::getUsualOccupationList()); 
    }

    public function getWorkAffiliationList(Request $request) {
        return response()->json(Helpers::getWorkAffiliationList()); 
    }

    public function getPlaceWorkType(Request $request) {
        return response()->json(Helpers::getPlaceWorkType()); 
    }
}
