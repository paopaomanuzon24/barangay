<?php

namespace App\Classes;

use Carbon\Carbon;

use App\Models\Barangay;
use App\Models\Citizenship;
use App\Models\ClassWorker;
use App\Models\Course;
use App\Models\Disability;
use App\Models\DocumentFile;
use App\Models\EducationLevel;
use App\Models\Ethnicity;
use App\Models\GroupsAndAffiliation;
use App\Models\MaritalStatus;
use App\Models\Language;
use App\Models\RelationshipType;
use App\Models\Religious;
use App\Models\ResidenceStatus;
use App\Models\UsualOccupation;
use App\Models\UserType;
use App\Models\WorkAffiliation;

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

    public function getClassWorkerList() {
        $classWorkerList = ClassWorker::get();

        $classWorkerArray = [];
        
        foreach ($classWorkerList as $row) {
            $classWorkerArray[$row->id] = $row->description;
        };

        return $classWorkerArray;
    }

    public function getCourseList() {
        $courseList = Course::get();

        $courseArray = [];
        
        foreach ($courseList as $row) {
            $courseArray[$row->id] = [
                'level_id' => $row->level_id,
                'code' => $row->code,
                'description' => $row->description
            ];
        };

        return $courseArray;
    }

    public function getDocumentFileList() {
        $documentList = DocumentFile::get();

        $documentArray = [];
        
        foreach ($documentList as $row) {
            $documentArray[$row->id] = $row->description;
        };

        return $documentArray;
    }

    public function getDisabilityList() {
        $disabilityList = Disability::get();

        $disabilityArray = [];
        
        foreach ($disabilityList as $row) {
            $disabilityArray[$row->id] = $row->description;
        };

        return $disabilityArray;
    }

    public function getEducationLevel() {
        $educationLevelList = EducationLevel::get();

        $educationLevelArray = [];
        
        foreach ($educationLevelList as $row) {
            $educationLevelArray[$row->id] = [
                'code' => $row->code,
                'description' => $row->description
            ];
        };

        return $educationLevelArray;
    }

    public function getEthnicityList() {
        $ethnicityList = Ethnicity::get();

        $ethnicityArray = [];
        
        foreach ($ethnicityList as $row) {
            $ethnicityArray[$row->id] = $row->description;
        };

        return $ethnicityArray;
    }

    public function getGroupsAndAffiliationList() {
        $list = GroupsAndAffiliation::get();

        $array = [];
        
        foreach ($list as $row) {
            $array[$row->id] = $row->description;
        };

        return $array;
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

    public function getRelationshipTypeList() {
        $relationshipTypeList = RelationshipType::get();

        $relationshipTypeArray = [];
        
        foreach ($relationshipTypeList as $row) {
            $relationshipTypeArray[$row->id] = [
                'code' => $row->code,
                'description' => $row->description
            ];
        };

        return $relationshipTypeArray;
    }

    public function getReligiousList() {
        $religiousList = Religious::get();

        $religiousArray = [];
        
        foreach ($religiousList as $row) {
            $religiousArray[$row->id] = $row->description;
        };

        return $religiousArray;
    }

    public function getUsualOccupationList() {
        $usualOccupationList = UsualOccupation::get();

        $usualOccupationArray = [];
        
        foreach ($usualOccupationList as $row) {
            $usualOccupationArray[$row->id] = $row->description;
        };

        return $usualOccupationArray;
    }

    public function getUserTypeList() {
        $userTypeList = UserType::get();

        $userTypeArray = [];
        
        foreach ($userTypeList as $row) {
            $userTypeArray[$row->id] = $row->name;
        };

        return $userTypeArray;
    }

    public function getWorkAffiliationList() {
        $workAffiliationList = WorkAffiliation::get();

        $workAffiliationArray = [];
        
        foreach ($workAffiliationList as $row) {
            $workAffiliationArray[$row->id] = $row->description;
        };

        return $workAffiliationArray;
    }

    public function getPlaceWorkType() {
        $array = [
            1 => "Same City",
            2 => "Foreign",
            3 => "Others"
        ];

        return $array;
    }

    public function getResidenceStatusList() {
        $statusList = ResidenceStatus::get();

        $statusArray = [];

        foreach ($statusList as $row) {
            $statusArray[$row->id] = $row->description;
        }

        return $statusArray;
    }
    
}
