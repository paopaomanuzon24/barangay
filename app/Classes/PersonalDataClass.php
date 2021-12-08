<?php

namespace App\Classes;

use Carbon\Carbon;

use App\Models\PersonalData;

class PersonalDataClass
{
    public function savePersonalData($request) {
        $user = $request->user();
        $resident = 5;
        $personalData = $user->personalData;

        if (empty($personalData)) {
            $personalData = new PersonalData;
            $personalData->user_id = $user->id;
            $user->user_type_id = $resident;
            $user->save();
        }

        $personalData->last_name = $request->last_name;
        $personalData->first_name = $request->first_name;
        $personalData->middle_name = $request->middle_name;
        $personalData->suffix = $request->suffix;
        $personalData->gender = strtoupper($request->gender);
        $personalData->marital_status_id = $request->marital_status_id;
        $personalData->religious_id = $request->religious_id;
        $personalData->citizenship = $request->citizenship;
        $personalData->citizenship_id = $request->citizenship_id;
        $personalData->birth_date = date("Y-m-d", strtotime($request->birth_date));
        $personalData->birth_place = $request->birth_place;
        $personalData->contact_no = $request->contact_no;
        $personalData->land_line = $request->land_line;
        $personalData->email = $request->email;
        $personalData->additional_contact_no = $request->additional_contact_no;
        $personalData->emergency_contact_no = $request->emergency_contact_no;
        $personalData->save();
    }
}
