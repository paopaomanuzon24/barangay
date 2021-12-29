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

use App\Models\RelationshipType;
use App\Models\User as UserModel;

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
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $class = new FamilyDataClass;
        $class->saveFamilyData($request);

        return customResponse()
            ->data(null)
            ->message('Record has been saved.')
            ->success()
            ->generate();       
    }

    public function getFamilyData(Request $request, $id) {
        $userData = UserModel::find($id);
        if (empty($userData)) {
            return customResponse()
                ->message("No data")
                ->data(null)
                ->failed()
                ->generate();
        }
        
        $familyData = $userData->familyData;

        return customResponse()
            ->message("Family data.")
            ->data($userData)
            ->success()
            ->generate();
    }

    public function getRelationshipTypeList(Request $request) {
        $relationshipTypeList = RelationshipType::select(
            'id',
            'code',
            'description'
        )
        ->get();

        return customResponse()
            ->message("List of relationship.")
            ->data($relationshipTypeList)
            ->success()
            ->generate();
    }
}
