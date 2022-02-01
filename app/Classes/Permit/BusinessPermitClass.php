<?php

namespace App\Classes\Permit;


use App\Models\PermitType;
use App\Models\Barangay;
use App\Models\PermitCategory;
use App\Models\PermitStatus;
use App\Models\User;

class BusinessPermitClass
{

    public function getBarangayId($barangay){

        $return = "";
        $barangayData = Barangay::all();
        $tempBarangay = $this->cleanString($barangay);
        $isBarangayExist = false;


        foreach($barangayData as $barangayRow){
            $barangayDesc = $this->cleanString($barangayRow->description);
            if($barangayDesc == $tempBarangay){
                $isBarangayExist = true;
                $return = $barangayRow->id;
                break;
            }
        }

        if(!$isBarangayExist){
            $barangayData = new Barangay;
            $barangayData->description = ucfirst($barangay);
            $barangayData->code = "";
            $barangayData->save();

            $return = $barangayData->id;
        }
        return $return;
    }

    public function getPermitCategoryId($permitCategory,$barangayId){

        $return = "";
        $categoryData = PermitCategory::where("barangay_id",$barangayId)->get();
        $tempCategory = $this->cleanString($permitCategory);
        $isCategoryExist = false;


        foreach($categoryData as $categoryRow){
            $categoryDesc = $this->cleanString($categoryRow->description);
            if($categoryDesc == $tempCategory){
                $isCategoryExist = true;
                $return = $categoryRow->id;
                break;
            }
        }

        if(!$isCategoryExist){
            $categoryData = new PermitCategory;
            $categoryData->description = ucfirst($permitCategory);
            $categoryData->barangay_id = $barangayId;
            $categoryData->save();

            $return = $categoryData->id;
        }
        return $return;
    }

    public function getPermitTypeId($permitType,$categoryId,$fee,$barangayId){

        $return = "";
        $typeData = PermitType::where("barangay_id",$barangayId)->get();
        $tempType = $this->cleanString($permitType);
        $isTypeExist = false;


        foreach($typeData as $typeRow){
            $typeDesc = $this->cleanString($typeRow->permit_name);
            if($typeDesc == $tempType){
                $isTypeExist = true;
                $return = $typeRow->id;
                break;
            }
        }

        if(!$isTypeExist){
            $typeData = new PermitType;
            $typeData->permit_name = ucfirst($permitType);
            $typeData->category_id = $categoryId;
            $typeData->barangay_id = $barangayId;
            $typeData->fee = !empty($fee) ? $fee  : 0;
            $typeData->save();

            $return = $typeData->id;
        }
        return $return;
    }

    public function getStatusId($status){

        $return = "";
        $statusData = PermitStatus::all();
        $tempStatus = $this->cleanString($status);
        $isStatusExist = false;

        foreach($statusData as $statusRow){
            $statusDesc = $this->cleanString($statusRow->description);
            if($statusDesc == $tempStatus){
                $isStatusExist = true;
                $return = $statusRow->id;
                break;
            }
        }

        if(!$isStatusExist){
            $statusData = new PermitStatus;
            $statusData->description = ucfirst($status);
            $statusData->save();

            $return = $statusData->id;
        }
        return $return;
    }

    public function getUserId($first_name,$middle_name,$last_name,$barangayId){
        $tempFirstName = trim(strtolower($first_name));
        $tempMiddleName = trim(strtolower($middle_name));
        $tempLastName = trim(strtolower($last_name));

        $return = "";
        $userData = User::where("barangay_id",$barangayId)
        ->whereRaw("TRIM(LOWER(first_name)) = ?",$tempFirstName)
        ->whereRaw("TRIM(LOWER(middle_name)) =?",$tempMiddleName)
        ->whereRaw("TRIM(LOWER(last_name)) =?",$tempLastName)->first();


        if(!empty($userData)){
           $return = $userData->id;
        }else{
            $userData = new User;
            $userData->first_name = $first_name;
            $userData->middle_name = $middle_name;
            $userData->last_name = $last_name;
            $userData->email = "";
            $userData->contact_no = "";
            $userData->gender = "";
            $userData->birth_date = date('Y')."-01"."-01";
            $userData->address = "";
            $userData->barangay_id = $barangayId;
            $userData->password = "";
            $userData->user_type_id = 6;
            $userData->is_barangay_system = 0;
            $userData->save();
            $return = $userData->id;
        }


        return $return;
    }


    private function cleanString($string){
        $string = strtolower($string);
        $string = trim($string);
        $string = str_replace(""," ",$string);
        return $string;
    }

}
