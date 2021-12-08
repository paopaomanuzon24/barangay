<?php

namespace App\Classes;

use Carbon\Carbon;

use App\Models\Barangay;
use App\Models\Citizenship;
use App\Models\Disability;
use App\Models\Ethnicity;
use App\Models\MaritalStatus;
use App\Models\Language;
use App\Models\Religious;
use App\Models\UserType;

class HelperClass
{
    public function getBarangayList() {
        $barangayList = Barangay::get();

        $barangayArray = [];
        
        foreach ($barangayList as $row) {
            $barangayArray[$row->id] = $row->description;
        };

        return $barangayArray;
    }

    public function getCitizenshipList() {
        $citizenshipList = Citizenship::get();

        $citizenshipArray = [];
        
        foreach ($citizenshipList as $row) {
            $citizenshipArray[$row->id] = $row->description;
        };

        return $citizenshipArray;
    }

    public function getDisabilityList() {
        $disabilityList = Disability::get();

        $disabilityArray = [];
        
        foreach ($disabilityList as $row) {
            $disabilityArray[$row->id] = $row->description;
        };

        return $disabilityArray;
    }

    public function getEthnicityList() {
        $ethnicityList = Ethnicity::get();

        $ethnicityArray = [];
        
        foreach ($ethnicityList as $row) {
            $ethnicityArray[$row->id] = $row->description;
        };

        return $ethnicityArray;
    }

    public function getMaritalStatusList() {
        $maritalStatusList = MaritalStatus::get();

        $maritalStatusArray = [];
        
        foreach ($maritalStatusList as $row) {
            $maritalStatusArray[$row->id] = $row->description;
        };

        return $maritalStatusArray;
    }

    public function getLanguageList() {
        $languageList = Language::get();

        $languageArray = [];
        
        foreach ($languageList as $row) {
            $languageArray[$row->id] = $row->description;
        };

        return $languageArray;
    }

    public function getRadioAddressType() {
        $array = [
            1 => "Permanent",
            2 => "Temporary",
        ];

        return $array;
    }

    public function getRadioCitizen(){
        $array = [
            1 => "Filipino Citizen",
            2 => "with Dual Citizenship",
            3 => "No"
        ];

        return $array;
    }

    public function getRadioEmployeeType() {
        $array = [
            1 => "Goverment",
            2 => "Private",
            3 => "Self-employed",
            4 => "Unemployed"
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

    public function getRadioTemporaryType() {
        $array = [
            1 => "Renter",
            2 => "Employment",
        ];

        return $array;
    }

    public function getReligiousList() {
        $religiousList = Religious::get();

        $religiousArray = [];
        
        foreach ($religiousList as $row) {
            $religiousArray[$row->id] = $row->description;
        };

        return $religiousArray;
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
