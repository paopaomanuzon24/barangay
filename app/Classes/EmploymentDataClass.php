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
        $employmentData->employment = !empty($request->employment) ? $request->employment : "";
        $employmentData->employment_address = !empty($request->employment_address) ? $request->employment_address : "";
        $employmentData->monthly_income = !empty($request->monthly_income) ? $request->monthly_income : 0;
        $employmentData->annual_income = !empty($request->annual_income) ? $request->annual_income : 0;
        $employmentData->save();
    }
}
