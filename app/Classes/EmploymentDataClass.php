<?php

namespace App\Classes;

use Carbon\Carbon;

use App\Models\EmploymentData;

class EmploymentDataClass
{
    public function saveEmploymentData($request) {
        $userData = $request->user();

        $employmentData = $userData->employmentData;
        if (empty($employmentData)) {
            $employmentData = new EmploymentData;
            $employmentData->user_id = $userData->id;
        }

        $employmentData->employment_type = $request->employment_type;
        $employmentData->usual_occupation_id = $request->usual_occupation_id;
        $employmentData->class_worker_id = $request->class_worker_id;
        $employmentData->work_affiliation_id = $request->work_affiliation_id;
        $employmentData->place_work_type = $request->place_work_type;
        $employmentData->place_work_type_specify = !empty($request->place_work_type_specify) ? $request->place_work_type_specify : "";
        $employmentData->employment = !empty($request->employment) ? $request->employment : "";
        $employmentData->employment_address = !empty($request->employment_address) ? $request->employment_address : "";
        $employmentData->monthly_income = !empty($request->monthly_income) ? $request->monthly_income : 0;
        $employmentData->annual_income = !empty($request->annual_income) ? $request->annual_income : 0;
        $employmentData->save();
    }
}
