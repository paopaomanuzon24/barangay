<?php

namespace App\Classes;

use Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\PersonalData;
use App\Models\ProfilePicture;
use App\Models\User;
use App\Models\ResidenceApplication;

use App\Classes\ResidenceApplicationClass;
use App\Models\BarangayIDSequence;

class PersonalDataClass
{
    public function saveProfile($request) {
        $user = $request->user();
        if (!empty($request->user_id)) {
            $user = User::find($request->user_id);
        }
        
        $profile = $user->profilePicture;
        if (empty($profile)) {
            $profile = new ProfilePicture;
            $profile->user_id = $user->id;
            $user->save();
        }

        if ($request->hasFile('profile')) {
            $path = 'images/profile';

            $image = $request->file('profile');
            $imageName = $image->getClientOriginalName();

            $request->file('profile')->storeAs("public/".$path,$imageName);
            
            $profile->profile_path = $path.'/'.$imageName;
            $profile->profile_name = $imageName;
        }

        $profile->save();

        return $profile;
    }
    
    public function savePersonalData($request) {
        $resident = 5;
        $approved = 1;

        $userData = User::find($request->user_id);
        if (empty($userData)) {
            $userData = new User;
            $userData->user_type_id = $resident;
            $userData->last_name = $request->last_name;
            $userData->first_name = $request->first_name;
            $userData->email = $request->email;
            $userData->contact_no = $request->contact_no;
            $userData->gender = strtoupper($request->gender);
            $userData->birth_date = date("Y-m-d", strtotime($request->birth_date));
            $userData->address = "";
            $userData->barangay_id = $request->barangay_id;
            $userData->password = Hash::make($request->last_name);
            $userData->save();
        }

        if (empty($request->user_id)) {
            $request->user_id = $userData->id;
            $request->status_id = $approved;
        }
        
        $personalData = $userData->personalData;

        if (empty($personalData)) {
            $personalData = new PersonalData;
            $personalData->user_id = $userData->id;
            $personalData->application_id = 0;
            $userData->email = $request->email;
            $userData->save();
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
        $personalData->country_id = $request->country_id;
        $personalData->province_id = $request->province_id;
        $personalData->municipality_id = $request->municipality_id;
        $personalData->save();

        if (empty($personalData->application_id)) {
            $residenceClass = new ResidenceApplicationClass;
            $residenceClass->updateResidenceApplication($request);

            $this->saveApplicationID($personalData);
        }

        return $personalData;
    }

    protected function saveApplicationID($personalData) {
        $residenceData = ResidenceApplication::where("user_id", $personalData->user_id)->first();
        $applicationID = date("Y") . $residenceData->id;
        $personalData->application_id = $applicationID;
        $personalData->save();
    }
}
