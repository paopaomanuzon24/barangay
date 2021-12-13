<?php

namespace App\Classes;

use Carbon\Carbon;

use App\Models\FamilyData;

class FamilyDataClass
{
    public function saveFamilyData($request) {
        $userData = $request->user();

        FamilyData::where("user_id", $userData->id)->each(function($row){
            $row->delete();
        });

        foreach ($request->relationship_type_id as $key => $value) {
            $familyData = new FamilyData;
            $familyData->user_id = $userData->id;
            $familyData->relationship_type_id = $request->relationship_type_id[$key];
            $familyData->first_name = $request->first_name[$key];
            $familyData->middle_name = !empty($request->middle_name[$key]) ? $request->middle_name[$key] : "";
            $familyData->last_name = $request->last_name[$key];
            $familyData->birth_date = date("Y-m-d", strtotime($request->birth_date[$key]));
            $familyData->contact_no = $request->contact_no[$key];
            $familyData->same_address = !empty($request->same_address[$key]) ? $request->same_address[$key] : 0;
            $familyData->address = $request->address[$key];
            $familyData->save();
        }
    }
}
