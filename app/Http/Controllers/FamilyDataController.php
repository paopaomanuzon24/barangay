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

use App\Models\FamilyData;
use App\Models\RelationshipType;
use App\Models\User as UserModel;

class FamilyDataController extends Controller
{
    public function list(Request $request, $id) {
        $userData = UserModel::find($id);
        if (empty($userData)) {
            return customResponse()
                ->message("No data")
                ->data(null)
                ->failed()
                ->generate();
        }
        
        // $familyData = $userData->familyData;

        $familyDataList = FamilyData::select(
            'family_data.id',
            'family_data.user_id',
            'family_data.relationship_type_id',
            'relationship_type.description as relationship_type_desc',
            'family_data.personal_data_id',
            'personal_data.first_name',
            'personal_data.middle_name',
            'personal_data.last_name',
            'personal_data.birth_date',
            'personal_data.contact_no',
            'address_data.full_address'
        )
        ->join("relationship_type", "relationship_type.id", "family_data.relationship_type_id")
        ->join("personal_data", "personal_data.id", "family_data.personal_data_id")
        ->join("address_data", "address_data.user_id", "family_data.user_id")
        ->where("family_data.user_id", $userData->id)
        ->paginate(
            (int) $request->get('per_page', 10),
            ['*'],
            'page',
            (int) $request->get('page', 1)
        );

        return customResponse()
            ->message("Family data.")
            ->data($familyDataList)
            ->success()
            ->generate();
    }

    public function getFamilyData(Request $request, $id) {
        $familyData = FamilyData::select(
            'family_data.id',
            'family_data.user_id',
            'family_data.relationship_type_id',
            'relationship_type.description as relationship_type_desc',
            'family_data.personal_data_id',
            'personal_data.first_name',
            'personal_data.middle_name',
            'personal_data.last_name',
            'personal_data.birth_date',
            'personal_data.contact_no',
            'address_data.full_address'
        )
        ->join("relationship_type", "relationship_type.id", "family_data.relationship_type_id")
        ->join("personal_data", "personal_data.id", "family_data.personal_data_id")
        ->join("address_data", "address_data.user_id", "family_data.user_id")
        ->find($id);

        return customResponse()
            ->message("Family data.")
            ->data($familyData)
            ->success()
            ->generate();
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'relationship_type_id' => 'required'
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

    public function destroy(Request $request, $id) {
        $familyData = FamilyData::find($id);
        if (!empty($familyData)) {
            $familyData->delete();
            return customResponse()
                ->message("Record has been deleted.")
                ->data(null)
                ->success()
                ->generate();
        }

        return customResponse()
            ->message("No data.")
            ->data(null)
            ->failed()
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
