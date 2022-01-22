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
use App\Models\EducationalData;
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

    public function list(Request $request, $id) {
        $userData = UserModel::find($id);
        if (empty($userData)) {
            return customResponse()
                ->message("No data")
                ->data(null)
                ->failed()
                ->generate();
        }

        // EducationLevel
        // $educationalList = $userData->educationalData;
        // $educationalOtherData = $userData->educationalOtherData;

        $educationalList = EducationalData::select(
            'educational_data.id',
            'educational_data.user_id',
            'educational_data.level_id',
            'education_level.description as level_desc',
            'educational_data.course_id',
            'courses.description as course_desc',
            'educational_data.school_name',
            'educational_data.year_graduated',
            'educational_data.highest_year_reached'
        )
        ->join("education_level", "education_level.id", "educational_data.level_id")
        ->leftJoin("courses", "courses.id", "educational_data.course_id")
        ->where("educational_data.user_id", $userData->id)
        ->paginate(
            (int) $request->get('per_page', 10),
            ['*'],
            'page',
            (int) $request->get('page', 1)
        );

        return customResponse()
            ->message("List of education level.")
            ->data($educationalList)
            ->success()
            ->generate();
    }

    public function getEducationalData(Request $request, $id) {
        $educationalData = EducationalData::select(
            'educational_data.id',
            'educational_data.user_id',
            'educational_data.level_id',
            'educational_data.course_id',
            'educational_data.school_name',
            'educational_data.year_graduated',
            'educational_data.highest_year_reached'
        )->find($id);

        return customResponse()
            ->message("Educational data.")
            ->data($educationalData)
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
