<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Classes\Report\InhabitantsReportClass;



class InhabitantsReportController extends Controller
{

    public function getInhabitantsReport(Request $request){
        $inhabitantReport = new InhabitantsReportClass;
        #SELECT * FROM residence_application WHERE status_id='1';
        $barangayId = !empty($request->barangay_id) ? $request->barangay_id : "";
        $approvedResidenceList = $inhabitantReport->getApprovedResidenceData();
       # $populationCount = count($approvedResidenceList);
        $populationCount = $inhabitantReport->getPopulationCount($barangayId,$approvedResidenceList);

        $ageGroupList = $inhabitantReport->getAgeGroupList($barangayId,$approvedResidenceList);

        $genderPopulationList = $inhabitantReport->getPopulationByGender($barangayId,$approvedResidenceList);

        $otherDataList = $inhabitantReport->getOtherPopulationData($barangayId,$approvedResidenceList);

        $populationByBarangayList = $inhabitantReport->getPopulationByBarangay($approvedResidenceList);



        $return = array(
            'population_count' => $populationCount,
            'age_group_list' => $ageGroupList,
            'gender_list' => array(
                'male' => $genderPopulationList['M'],
                'female' => $genderPopulationList['F']
            ),
            'other_data' => array(
                'pwd' => $otherDataList['pwd'],
                'single_parent' => $otherDataList['singleParent'],
                'lgbtq' => $otherDataList['lgbtq'],
            ),
            'voter_count' => $otherDataList['voter'],
            'population_by_barangay' => $populationByBarangayList



        );
        $return = "eirra";

        return $return;
    }









}
