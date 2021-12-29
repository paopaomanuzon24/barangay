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

use App\Models\EducationLevel;
use App\Models\Course;
use App\Models\User as UserModel;

class EducationalDataController extends Controller
{
    public function store(Request $request) {
        $class = new EducationalDataClass;
        $class->saveEducationalData($request);

        return customResponse()
            ->data(null)
            ->message('Record has been saved.')
            ->success()
            ->generate(); 
    }

    public function getEducationalData(Request $request, $id) {
        $userData = UserModel::find($id);
        if (empty($userData)) {
            return customResponse()
                ->message("No data")
                ->data(null)
                ->failed()
                ->generate();
        }
        
        $educationalList = $userData->educationalData;
        $educationalOtherData = $userData->educationalOtherData;

        return customResponse()
            ->message("List of education level.")
            ->data($userData)
            ->success()
            ->generate();
    }

    public function getEducationLevel(Request $request) {
        $educationLevelList = EducationLevel::select(
            'id',
            'code',
            'description'
        )
        ->get();

        return customResponse()
            ->message("List of education level.")
            ->data($educationLevelList)
            ->success()
            ->generate();
    }

    public function getCourseList(Request $request) {
        $courseList = Course::select(
            'id',
            'code',
            'description'
        )
        ->get();

        return customResponse()
            ->message("List of course.")
            ->data($courseList)
            ->success()
            ->generate();
    }
}
