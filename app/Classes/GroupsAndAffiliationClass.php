<?php

namespace App\Classes;

use Carbon\Carbon;

use App\Models\GroupsAndAffiliationData;
use App\Models\User;

class GroupsAndAffiliationClass
{
    public function saveGroupsAndAffiliation($request) {
        $userData = $request->user();
        if (!empty($request->user_id)) {
            $userData = User::find($request->user_id);
        }

        GroupsAndAffiliationData::where("user_id", $request->user_id)->each(function($row) {
            $row->delete();
        });

        foreach ($request->groups_and_affiliation_id as $key => $value) {
            $groupData = new GroupsAndAffiliationData;
            $groupData->user_id = $userData->id;
            $groupData->groups_and_affiliation_id = $value;
            $groupData->save();
        }
    }
}
