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

use App\Models\ClassWorker;
use App\Models\UsualOccupation;
use App\Models\WorkAffiliation;
use App\Models\User as UserModel;

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

    public function getEmploymentData(Request $request, $id) {
        $userData = UserModel::find($id);
        if (empty($userData)) {
            return customResponse()
                ->message("No data")
                ->data(null)
                ->failed()
                ->generate();
        }
        
        $employmentData = $userData->employmentData;

        return customResponse()
            ->message("Employment data")
            ->data($userData)
            ->success()
            ->generate();
    }

    public function getClassWorkerList(Request $request) {
        $classWorkerList = ClassWorker::select(
            'id',
            'description'
        )
        ->get();

        return customResponse()
            ->message("List of class worker")
            ->data($classWorkerList)
            ->success()
            ->generate();
    }

    public function getUsualOccupationList(Request $request) {
        $usualOccupationList = UsualOccupation::select(
            'id',
            'description'
        )
        ->get();
        
        return customResponse()
            ->message("List of usual occupation")
            ->data($usualOccupationList)
            ->success()
            ->generate();
    }

    public function getWorkAffiliationList(Request $request) {
        $workAffiliationList = WorkAffiliation::select(
            'id',
            'description'
        )
        ->get();
        
        return customResponse()
            ->message("List of work affiliation")
            ->data($workAffiliationList)
            ->success()
            ->generate();
    }

    public function getPlaceWorkType(Request $request) {
        return customResponse()
            ->message("Place work type")
            ->data(Helpers::getPlaceWorkType())
            ->success()
            ->generate();
    }
}
