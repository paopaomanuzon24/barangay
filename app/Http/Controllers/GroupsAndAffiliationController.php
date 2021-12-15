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

class GroupsAndAffiliationController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'groups_and_affiliation_id' => 'required|array'
        ]);

        $class = new GroupsAndAffiliationClass;
        $class->saveGroupsAndAffiliation($request);

        return response()->json([
            'message' => 'Record has been saved.'
        ], 201);
    } 

    public function getGroupsAndAffiliationData(Request $request) {
        $userData = $request->user();
        $groupData = $request->user()->groupsAndAffiliationData;
        return response()->json($userData);
    }

    public function getGroupsAndAffiliationList(Request $request) {
        return response()->json(Helpers::getGroupsAndAffiliationList());
    }
}
