<?php

namespace App\Classes;

use Carbon\Carbon;

use App\Models\EducationalData;
use App\Models\EducationalOtherData;
use App\Models\User;

class EducationalDataClass
{
    public function saveEducationalData($request) {
        $userData = $request->user();
        if (!empty($request->user_id)) {
            $userData = User::find($request->user_id);
        }

        $educationalList = $userData->educationalData;

        EducationalData::where("user_id", $userData->id)->each(function($row){
            $row->delete();
        });

        foreach ($request->level_id as $key => $value) {
            $educationalData = new EducationalData;
            $educationalData->user_id = $userData->id;
            $educationalData->level_id = $request->level_id[$key];
            $educationalData->level_code = !empty($request->level_code[$key]) ? $request->level_code[$key] : "";
            $educationalData->course_id = $request->tertiary_course;
            $educationalData->school_name = !empty($request->school_name[$key]) ? $request->school_name[$key] : "";
            $educationalData->school_address = !empty($request->school_address[$key]) ? $request->school_address[$key] : "";
            $educationalData->year_from = !empty($request->year_from[$key]) ? $request->year_from[$key] : "";
            $educationalData->year_to = !empty($request->year_to[$key]) ? $request->year_to[$key] : "";
            $educationalData->save();
        }

        $this->saveEducationalOtherData($request);
    }

    protected function saveEducationalOtherData($request) {
        $userData = $request->user();
        if (!empty($request->user_id)) {
            $userData = User::find($request->user_id);
        }

        $educationalOtherData = $userData->educationalOtherData;
        if (empty($educationalOtherData)) {
            $educationalOtherData = new EducationalOtherData;
            $educationalOtherData->user_id = $userData->id;
        }

        $educationalOtherData->level_id = $request->highest_degree_id;
        $educationalOtherData->course_id = $request->course_id;
        $educationalOtherData->save();
    }
}
