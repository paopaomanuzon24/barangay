<?php

namespace App\Classes;

use Hash;
use Carbon\Carbon;

use App\Models\PersonalData;
use App\Models\User;

class UserManagementClass
{
    public function saveUser($request) {
        $userData = User::find($request->user_id);
        if (empty($userData)) {
            $userData = new User;
        }

        $userData->user_type_id = $request->user_type_id;
        $userData->last_name = $request->last_name;
        $userData->first_name = $request->first_name;
        $userData->email = $request->email;
        $userData->contact_no = $request->contact_no;
        $userData->gender = strtoupper($request->gender);
        $userData->birth_date = date("Y-m-d", strtotime($request->birth_date));
        $userData->address = $request->address;
        $userData->barangay_id = $request->barangay_id;
        if (!empty($request->password)) {
            $userData->password = Hash::make($request->password);
        }
        $userData->save();

        $this->updateEmail($request, $userData);
    }

    public function updateEmail($request, $userData) {
        $personalData = PersonalData::where("user_id", $userData->id)->first();
        if (!empty($personalData)) {
            $personalData->email = $request->email;
            $personalData->save();
        }
    }
}
