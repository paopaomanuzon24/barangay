<?php

namespace App\Http\Controllers;

use Helpers;
use Session;
use Validator;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Classes\GroupsAndAffiliationClass;

use App\Models\GroupsAndAffiliation;

use App\Models\User as UserModel;

class GroupsAndAffiliationController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'groups_and_affiliation_id' => 'required|array'
        ]);

        $class = new GroupsAndAffiliationClass;
        $class->saveGroupsAndAffiliation($request);

        return customResponse()
            ->data(null)
            ->message('Record has been saved.')
            ->success()
            ->generate(); 
    } 

    public function getGroupsAndAffiliationData(Request $request, $id) {
        $userData = UserModel::find($id);
        if (empty($userData)) {
            return customResponse()
                ->message("No data")
                ->data(null)
                ->failed()
                ->generate();
        }
        
        $employmentData = $userData->groupsAndAffiliationData;

        return customResponse()
            ->message("Groups and affiliation data.")
            ->data($userData)
            ->success()
            ->generate();
    }

    public function getGroupsAndAffiliationList(Request $request) {
        $list = GroupsAndAffiliation::select(
            'id',
            'description'
        )
        ->get();

        return customResponse()
            ->message("List of groups and affiliation.")
            ->data($list)
            ->success()
            ->generate();
    }
}
