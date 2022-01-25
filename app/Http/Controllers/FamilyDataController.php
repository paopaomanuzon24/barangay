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
    public function userList(Request $request, $id) {
        $familyDataList = FamilyData::where("user_id", $id)->get();

        $familyDataArray = [
            $id
        ];

        foreach ($familyDataList as $row) {
            $familyDataArray[] = $row->family_user_id;
        }

        $removeUserTypeArray = [
            UserModel::SUPER_ADMIN,
            UserModel::ADMIN,
            UserModel::TREASURY,
            UserModel::SECRETARY
        ];

        $userList = UserModel::select(
            'users.id',
            'first_name',
            'middle_name',
            'last_name',
            'barangay_id',
            'barangays.description as barangay_desc',
            'user_type_id',
            'user_type.name as user_type_desc',
            'contact_no',
            'address'
        )
        ->leftJoin("barangays", "barangays.id", "users.barangay_id")
        ->leftJoin("user_type", "user_type.id", "users.user_type_id");

        if ($request->search) {
            $userList = $userList->where(function($q) use($request){
                $q->orWhereRaw("CONCAT_WS(' ',CONCAT(last_name,','),first_name,first_name) LIKE ?","%".$request->search."%");
            });
        }

        if ($request->barangay_id) {
            $userList = $userList->where("users.barangay_id", $request->barangay_id);
        }

        if ($request->user_type) {
            $userList = $userList->where("users.user_type_id", $request->user_type);
        }

        if (count($familyDataArray) > 0) {
            $userList = $userList->whereNotIn("users.id", $familyDataArray);
        }

        $userList = $userList->whereNotIn("users.user_type_id", $removeUserTypeArray);

        $userList = $userList->paginate(
            (int) $request->get('per_page', 10),
            ['*'],
            'page',
            (int) $request->get('page', 1)
        );
        
        return customResponse()
            ->message("Family data.")
            ->data($userList)
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
        
        // $familyData = $userData->familyData;

        $familyDataList = FamilyData::select(
            'family_data.id',
            'family_data.user_id',
            'family_data.relationship_type_id',
            'relationship_type.description as relationship_type_desc',
            'family_data.family_user_id',
            'users.first_name',
            'users.middle_name',
            'users.last_name',
            'users.birth_date',
            'users.contact_no',
            'users.address'
        )
        ->leftJoin("relationship_type", "relationship_type.id", "family_data.relationship_type_id")
        ->leftJoin("users", "users.id", "family_data.family_user_id")
        // ->leftJoin("address_data", "address_data.user_id", "family_data.user_id")
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
            'family_data.family_user_id',
            'users.first_name',
            'users.middle_name',
            'users.last_name',
            'users.birth_date',
            'users.contact_no',
            'users.address'
        )
        ->leftJoin("relationship_type", "relationship_type.id", "family_data.relationship_type_id")
        ->leftJoin("users", "users.id", "family_data.family_user_id")
        // ->leftJoin("address_data", "address_data.user_id", "family_data.user_id")
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
