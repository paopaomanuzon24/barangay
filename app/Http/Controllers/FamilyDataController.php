<?php

namespace App\Http\Controllers;

use Helpers;
use Session;
use Validator;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Classes\FamilyDataClass;

class FamilyDataController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'last_name' => 'required|array',
            'first_name' => 'required|array',
            'birth_date' => 'required|array',
            'contact_no' => 'required|array',
            'address' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()
            ], 400);
        }

        $class = new FamilyDataClass;
        $class->saveFamilyData($request);

        return response()->json([
            'message' => 'Record has been saved.'
        ], 201);        
    }

    public function getFamilyData(Request $request) {
        $userData = $request->user();
        $familyData = $request->user()->familyData;
        return response()->json($userData);
    }

    public function getRelationshipTypeList(Request $request) {
        return response()->json(Helpers::getRelationshipTypeList());
    }
}
