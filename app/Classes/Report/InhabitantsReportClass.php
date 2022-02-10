<?php

namespace App\Classes\Report;


use App\Models\ResidenceApplication;
use App\Models\Barangay;

class InhabitantsReportClass
{


    public function getApprovedResidenceData(){
        #SELECT * FROM residence_application WHERE status_id='1';
        $approvedResidenceList = array();
        $residenceData = ResidenceApplication::approvedResidence()->with('user','personalData','otherData')->get();
        foreach($residenceData as $residenceRow){
            $approvedResidenceList[] = $residenceRow->getOriginal();

        }
        return $approvedResidenceList;

    }

    public function getPopulationCount($barangayId,$approvedResidenceList){

        $populationCount = 0;
        foreach($approvedResidenceList as $residenceRow){
            if(!empty($barangayId)){
                if($residenceRow->user->barangay_id = $barangayId){
                    $populationCount++;
                }
            }else{
                $populationCount++;
            }
        }

        return $populationCount;
    }

    public function getAgeGroupList($barangayId,$approvedResidenceList){

        $ageGroupList = array(
            'children' => 0,
            'youth' => 0,
            'adult' => 0,
            'seniors' => 0
        );
        foreach($approvedResidenceList as $residenceRow){

            if(!empty($barangayId)){
                if($residenceRow->user->barangay_id = $barangayId){
                    $birthDate = $residenceRow->personalData->birth_date;

                    $age = $this->getAge($birthDate);

                    switch(true){
                        case ($age <= 14 && $age >= 0):
                            $ageGroupList['children']++;
                        break;
                        case ($age <= 24 && $age >=15):
                            $ageGroupList['youth']++;
                        break;
                        case ($age <= 64 && $age >=25):
                            $ageGroupList['adult']++;
                        break;
                        case ($age >=65):
                            $ageGroupList['seniors']++;
                        break;
                    }
                }
            }else{
                $birthDate = $residenceRow->personalData->birth_date;

                $age = $this->getAge($birthDate);

                switch(true){
                    case ($age <= 14 && $age >= 0):
                        $ageGroupList['children']++;
                    break;
                    case ($age <= 24 && $age >=15):
                        $ageGroupList['youth']++;
                    break;
                    case ($age <= 64 && $age >=25):
                        $ageGroupList['adult']++;
                    break;
                    case ($age >=65):
                        $ageGroupList['seniors']++;
                    break;
                }
            }
        }

        return $ageGroupList;
    }


    private function getAge($birthDate){

        $birthDate = date('m/d/Y',strtotime($birthDate));

        $birthDate = explode("/", $birthDate);
        //get age from date or birthdate
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
            ? ((date("Y") - $birthDate[2]) - 1)
            : (date("Y") - $birthDate[2]));
        return $age;
    }



    public function getPopulationByGender($barangayId,$approvedResidenceList){

        $genderPopulationList = array(
            'M' => 0,
            'F' => 0
        );
        foreach($approvedResidenceList as $residenceRow){
            if(!empty($barangayId)){
                if($residenceRow->user->barangay_id = $barangayId){
                    if($residenceRow->personalData->gender=="M"){
                        $genderPopulationList['M']++;
                    }
                    if($residenceRow->personalData->gender=="F"){
                        $genderPopulationList['F']++;
                    }

                }
            }else{
                if($residenceRow->personalData->gender=="M"){
                    $genderPopulationList['M']++;
                }
                if($residenceRow->personalData->gender=="F"){
                    $genderPopulationList['F']++;
                }
            }
        }

        return $genderPopulationList;
    }

    public function getOtherPopulationData($barangayId,$approvedResidenceList){
        $otherDataList = array(
            'pwd' => 0,
            'singleParent' =>0,
            'lgbtq' => 0,
            'voter' => 0
        );
        foreach($approvedResidenceList as $residenceRow){
            if(!empty($barangayId)){
                if($residenceRow->user->barangay_id = $barangayId){
                    if(!empty($residenceRow->otherData->disabled)){
                        $otherDataList['pwd']++;
                    }
                    if(!empty($residenceRow->otherData->is_single_parent)){
                        $otherDataList['singleParent']++;
                    }
                    if(!empty($residenceRow->otherData->community)){
                        $otherDataList['lgbtq']++;
                    }
                    if(!empty($residenceRow->otherData->is_voter)){
                        $otherDataList['voter']++;
                    }

                }
            }else{
                if(!empty($residenceRow->otherData->disabled)){
                    $otherDataList['pwd']++;
                }
                if(!empty($residenceRow->otherData->is_single_parent)){
                    $otherDataList['singleParent']++;
                }
                if(!empty($residenceRow->otherData->community)){
                    $otherDataList['lgbtq']++;
                }
                if(!empty($residenceRow->otherData->is_voter)){
                    $otherDataList['voter']++;
                }
            }
        }

        return $otherDataList;
    }

    public function getPopulationByBarangay($approvedResidenceList){

        $populationByBarangayList = array();
        $barangayData = Barangay::fromBarangaySystem()->get();

        foreach($barangayData as $barangayRow){
            $populationByBarangayList[$barangayRow->id] = array(
                'barangay' => $barangayRow->description,
                'male' => 0,
                'female' => 0,
                'voter' => 0,
                'seniors' => 0,
                'total' => 0
            );

            $genderPopulationList = $this->getPopulationByGender($barangayRow->id,$approvedResidenceList);

            $otherDataList = $this->getOtherPopulationData($barangayRow->id,$approvedResidenceList);

            $ageGroupList = $this->getAgeGroupList($barangayRow->id,$approvedResidenceList);

            $populationByBarangayList[$barangayRow->id]['male'] = $genderPopulationList['M'];
            $populationByBarangayList[$barangayRow->id]['female'] = $genderPopulationList['F'];
            $populationByBarangayList[$barangayRow->id]['voter'] = $otherDataList['voter'];
            $populationByBarangayList[$barangayRow->id]['seniors'] = $ageGroupList['seniors'];

            $total = 0;
            $total += $genderPopulationList['M'];
            $total += $genderPopulationList['F'];
            $total += $otherDataList['voter'];
            $total += $ageGroupList['seniors'];

            $populationByBarangayList[$barangayRow->id]['total'] = $total;

        }

        return $populationByBarangayList;


    }

}
