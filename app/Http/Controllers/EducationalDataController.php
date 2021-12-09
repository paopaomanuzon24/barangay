<?php

namespace App\Http\Controllers;

use Helpers;
use Session;
use Validator;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Classes\EducationalDataClass;

class EducationalDataController extends Controller
{
    public function store(Request $request) {
        $class = new EducationalDataClass;
        $class->saveEducationalData($request);

        return response()->json([
            'message' => 'Record has been saved.'
        ], 201);  
    }

    public function getEducationalData(Request $request) {
        $userData = $request->user();
        $educationalList = $request->user()->educationalData;
        $educationalOtherData = $request->user()->educationalOtherData;
        return response()->json($userData);
    }

    public function getEducationLevel(Request $request) {
        return response()->json(Helpers::getEducationLevel());
    }

    public function getCourseList(Request $request) {
        return response()->json(Helpers::getCourseList());
    }
}
