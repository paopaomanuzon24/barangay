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
    public function getAlcoholStatus() {
        $array = array(
            [
                'id' => 1,
                'description' => 'Occasionally'
            ],
            [
                'id' => 2,
                'description' => 'Moderately'
            ],
        );

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

    public function getGarageAndParkingList() {
        $array = array(
            [
                'id' => 1,
                'description' => 'Yes for one car'
            ],
            [
                'id' => 2,
                'description' => 'Yes for more than two cars'
            ],
            [
                'id' => 3,
                'description' => 'Yes for bike and tricycle'
            ],
            [
                'id' => 4,
                'description' => 'No'
            ]
        );

        return $array;
    }

    public function getGroupsAndAffiliationList() {
        $list = GroupsAndAffiliation::get();

        $array = [];
        
        foreach ($list as $row) {
            $array[$row->id] = $row->description;
        };

        return $array;
    }

    public function getInternetAccess() {
        $array = array(
            [
                'id' => 1,
                'description' => 'Yes, Fiber'
            ],
            [
                'id' => 2,
                'description' => 'Yes, Cellular Data'
            ],
            [
                'id' => 3,
                'description' => 'No'
            ],
        );

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
        $array = array(
            [
                'id' => 1,
                'description' => 'Permanent'
            ],
            [
                'id' => 2,
                'description' => 'Temporary'
            ],
        );

        return $array;
    }

    public function getRadioCitizen(){
        $array = array(
            [
                'id' => 1,
                'description' => 'Filipino Citizen'
            ],
            [
                'id' => 2,
                'description' => 'with Dual Citizenship'
            ],
            [
                'id' => 3,
                'description' => 'No'
            ],
        );

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
        $array = array(
            [
                'id' => 1,
                'code' => 'M',
                'description' => 'Male'
            ],
            [
                'id' => 2,
                'code' => 'F',
                'description' => 'Female'
            ],
        );

        return $array;
    }

    public function getRadioResidenceType() {
        $array = array(
            [
                'id' => 1,
                'description' => 'Same city / municipality'
            ],
            [
                'id' => 2,
                'description' => 'Foreign country'
            ],
            [
                'id' => 3,
                'description' => 'Unknown'
            ],
        );

        return $array;
    }

    public function getRadioTemporaryType() {
        $array = array(
            [
                'id' => 1,
                'description' => 'Renter'
            ],
            [
                'id' => 2,
                'description' => 'Employment'
            ],
        );

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

    public function getSepticTankStatusList() {
        $array = array(
            [
                'id' => 1,
                'description' => "No, we don't have"
            ],
            [
                'id' => 2,
                'description' => 'Yes, we have'
            ]
        );

        return $array;
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
        $array = array(
            [
                'id' => 1,
                'description' => 'Same City'
            ],
            [
                'id' => 2,
                'description' => 'Foreign'
            ],
            [
                'id' => 3,
                'description' => 'Others'
            ],
        );

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
