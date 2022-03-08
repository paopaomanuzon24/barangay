<?php

namespace App\Classes;

use Hash;
use Carbon\Carbon;

use App\Models\PersonalData;
use App\Models\User;

use App\Classes\PersonalDataClass;

class UserManagementClass
{
    public function saveUser($request) {
        $userData = User::find($request->user_id);
        if (empty($userData)) {
            $userData = new User;
            $userData->password = Hash::make($request->last_name);
        }

        $userData->user_type_id = !empty($request->user_type_id) ? $request->user_type_id : 7;
        $userData->last_name = $request->last_name;
        $userData->first_name = $request->first_name;
        $userData->email = $request->email;
        $userData->contact_no = $request->contact_no;
        $userData->gender = strtoupper($request->gender);
        $userData->birth_date = date("Y-m-d", strtotime($request->birth_date));
        $userData->address = $request->address;
        $userData->barangay_id = $request->barangay_id;
        $userData->is_active = !empty($request->is_active) ? $request->is_active : 0;
        // if (!empty($request->password)) {
        //     $userData->password = Hash::make($request->password);
        // }
        $userData->save();

        $this->updateEmail($request, $userData);

        if (!empty($userData->barangay_id)) {
            if (empty($request->user_id)) {
                $request->user_id = $userData->id;
                $request->status_id = 1;
                if ($userData->user_type_id==5) {
                    $personalDataClass = new PersonalDataClass;
                    $personalDataClass->savePersonalData($request);
                }
            }
        }
    }

    public function updateEmail($request, $userData) {
        $personalData = PersonalData::where("user_id", $userData->id)->first();
        if (!empty($personalData)) {
            $personalData->email = $request->email;
            $personalData->save();
        }
    }
}
