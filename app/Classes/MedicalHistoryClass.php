<?php

namespace App\Classes;

use Carbon\Carbon;

use App\Models\MedicalHistory;
use App\Models\MedicalHistoryDisease;
use App\Models\MedicalActiveCondition;
use App\Models\MedicalHistoryVaccine;
use App\Models\User;

class MedicalHistoryClass
{
    public function saveMedicalHistory($request) {
        $userData = $request->user();
        if (!empty($request->user_id)) {
            $userData = User::find($request->user_id);
        }

        $medicalHistoryData = $userData->medicalHistory;
        if (empty($medicalHistoryData)) {
            $medicalHistoryData = new MedicalHistory;
            $medicalHistoryData->user_id = $userData->id;
        }

        $medicalHistoryData->height = !empty($request->height) ? $request->height : "";
        $medicalHistoryData->weight = !empty($request->weight) ? $request->weight : "";
        $medicalHistoryData->blood_type = !empty($request->blood_type) ? $request->blood_type : "";
        $medicalHistoryData->smoke_no = !empty($request->smoke_no) ? $request->smoke_no : "";
        $medicalHistoryData->alocohol_no = !empty($request->alocohol_no) ? $request->alocohol_no : "";
        $medicalHistoryData->alcohol_status = !empty($request->alcohol_status) ? $request->alcohol_status : "";
        $medicalHistoryData->commorbidity = !empty($request->commorbidity) ? $request->commorbidity : 0;
        $medicalHistoryData->other_medical_history = !empty($request->other_medical_history) ? $request->other_medical_history : "";
        $medicalHistoryData->allergies = !empty($request->allergies) ? $request->allergies : "";
        // $medicalHistoryData->vaccination = !empty($request->vaccination) ? $request->vaccination : "";
        $medicalHistoryData->save();

        $this->saveMedicalHistoryDisease($request, $medicalHistoryData);
        $this->saveMedicalActiveCondition($request, $medicalHistoryData);
        $this->saveMedicalHistoryVaccine($request, $medicalHistoryData);
    }

    protected function saveMedicalHistoryDisease($request, $medicalHistoryData) {
        MedicalHistoryDisease::where("medical_history_id", $medicalHistoryData->id)->each(function($row) {
            $row->delete();
        });

        foreach ($request->disease_id as $key => $value) {
            if (!empty($value)) {
                $medHistoryDiseaseData = new MedicalHistoryDisease;
                $medHistoryDiseaseData->medical_history_id = $medicalHistoryData->id;
                $medHistoryDiseaseData->disease_id = $value;
                $medHistoryDiseaseData->save();
            }
        }
    }

    protected function saveMedicalActiveCondition($request, $medicalHistoryData) {
        MedicalActiveCondition::where("medical_history_id", $medicalHistoryData->id)->each(function($row) {
            $row->delete();
        });

        foreach ($request->disease_id as $key => $value) {
            if (!empty($value)) {
                $medActiveCondionData = new MedicalActiveCondition;
                $medActiveCondionData->medical_history_id = $medicalHistoryData->id;
                $medActiveCondionData->active_medical_condition = !empty($request->active_medical_condition[$key]) ? $request->active_medical_condition[$key] : "";
                $medActiveCondionData->active_medication = !empty($request->active_medication[$key]) ? $request->active_medication[$key] : 0;
                $medActiveCondionData->save();
            }
        }
    }

    protected function saveMedicalHistoryVaccine($request, $medicalHistoryData) {
        MedicalHistoryVaccine::where("medical_history_id", $medicalHistoryData->id)->each(function($row) {
            $row->delete();
        });

        foreach ($request->vaccination as $key => $value) {
            if (!empty($value)) {
                $medicalHistoryVaccine = new MedicalHistoryVaccine;
                $medicalHistoryVaccine->medical_history_id = $medicalHistoryData->id;
                $medicalHistoryVaccine->vaccine_id = $value;
                $medicalHistoryVaccine->save();
            }
        }
    }
}
