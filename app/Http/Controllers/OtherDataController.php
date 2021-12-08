<?php

namespace App\Http\Controllers;

use Helpers;
use Session;
use Validator;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Classes\OtherDataClass;

class OtherDataController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'language' => 'required',
            'disabled' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()
            ], 400);
        }

        $class = new OtherDataClass;
        $class->saveOtherData($request);

        return response()->json([
            'message' => 'Record has been saved.'
        ], 201);
    }

    public function getOtherData(Request $request) {
        $otherData = $request->user()->otherData;
        $otherDataLanguage = !empty($request->user()->otherData->language) ? $request->user()->otherData->language : "";
        return response()->json($otherData);
    }

    public function getEthnicityList(Request $request) {
        return response()->json(Helpers::getEthnicityList());
    }

    public function getLanguageList(Request $request) {
        return response()->json(Helpers::getLanguageList());
    }

    public function getDisabilityList(Request $request) {
        return response()->json(Helpers::getDisabilityList());
    }

}
