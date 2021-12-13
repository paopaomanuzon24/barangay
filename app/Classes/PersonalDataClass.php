<?php

namespace App\Classes;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\PersonalData;
use App\Models\User;

class PersonalDataClass
{
    public function getPersonalDataList($request) {
        $peronalDataList = PersonalData::select(
            'personal_data.id',
            'personal_data.user_id',
            'personal_data.resident_id',
            'personal_data.first_name',
            'personal_data.middle_name',
            'personal_data.last_name',
            'users.barangay_id',
            'personal_data.birth_date'
        )
        ->join("users", "users.id", "personal_data.user_id");

        if ($request->search) {
            $peronalDataList = $peronalDataList->where(function($q) use($request){
                $q->orWhereRaw("personal_data.resident_id LIKE ?","%".$request->search."%");
                $q->orWhereRaw("CONCAT_WS(' ',CONCAT(personal_data.last_name,','),personal_data.first_name,personal_data.first_name) LIKE ?","%".$request->search."%");
            });
        }

        if ($request->barangay_id) {
            $peronalDataList = $peronalDataList->where("users.barangay_id", $request->barangay_id);
        }

        $peronalDataList = $peronalDataList->get();
        
        return $peronalDataList;
    }
    
    public function savePersonalData($request) {
        $user = $request->user();
        if (!empty($request->user_id)) {
            $user = User::find($request->user_id);
        }
        
        $resident = 5;
        $personalData = $user->personalData;

        if (empty($personalData)) {
            $personalData = new PersonalData;
            $personalData->user_id = $user->id;
            $personalData->resident_id = 0;
            // $user->user_type_id = $resident;
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

        if (empty($personalData->resident_id)) {
            $this->saveResidentID($personalData);
        }
    }

    protected function saveResidentID($personalData) {
        $residentID = date("Y") . $personalData->id;
        $personalData->resident_id = $residentID;
        $personalData->save();
    }
}
