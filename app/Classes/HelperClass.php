<?php

namespace App\Classes;

use Carbon\Carbon;

use App\Models\Barangay;
use App\Models\MaritalStatus;
use App\Models\Citizenship;
use App\Models\Religious;
use App\Models\UserType;

class HelperClass
{

    public function getRadioCitizen(){
        $array = [
            1 => "Filipino Citizen",
            2 => "with Dual Citizenship",
            3 => "No"
        ];

        return $array;
    }

    public function getRadioGender() {
        $array = [
            'M' => "Male",
            'F' => "Female",
        ];

        return $array;
    }

    public function getBarangayList() {
        $barangayList = Barangay::get();

        $barangayArray = [];
        
        foreach ($barangayList as $row) {
            $barangayArray[$row->id] = $row->description;
        };

        return $barangayArray;
    }

    public function getMaritalStatusList() {
        $maritalStatusList = MaritalStatus::get();

        $maritalStatusArray = [];
        
        foreach ($maritalStatusList as $row) {
            $maritalStatusArray[$row->id] = $row->description;
        };

        return $maritalStatusArray;
    }

    public function getReligiousList() {
        $religiousList = Religious::get();

        $religiousArray = [];
        
        foreach ($religiousList as $row) {
            $religiousArray[$row->id] = $row->description;
        };

        return $religiousArray;
    }

    public function getCitizenshipList() {
        $citizenshipList = Citizenship::get();

        $citizenshipArray = [];
        
        foreach ($citizenshipList as $row) {
            $citizenshipArray[$row->id] = $row->description;
        };

        return $citizenshipArray;
    }

    public function getUserTypeList() {
        $userTypeList = UserType::get();

        $userTypeArray = [];
        
        foreach ($userTypeList as $row) {
            $userTypeArray[$row->id] = $row->name;
        };

        return $userTypeArray;
    }
    
}
