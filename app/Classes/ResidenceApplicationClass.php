<?php

namespace App\Classes;

use Carbon\Carbon;

use App\Models\ResidenceApplication;
use App\Models\User;

class ResidenceApplicationClass
{
    public function updateResidenceApplication($request) {
        $user = $request->user();
        if (!empty($request->user_id)) {
            $user = User::find($request->user_id);
        }

        $approved = 1;
        $forApproval = 3;

        $residenceAppData = $user->residenceApplicationStatus;

        if (empty($residenceAppData)) {
            $residenceAppData = new ResidenceApplication;
            $residenceAppData->user_id = $user->id;
        }

        $residenceAppData->status_id = !empty($request->status_id) ? $request->status_id : $forApproval;
        $residenceAppData->remarks = !empty($request->remarks) ? $request->remarks : "";
        $residenceAppData->save();

        if ($residenceAppData->status_id==$approved) {
            $this->updateUserTypeStatus($request);
        }
    }

    protected function updateUserTypeStatus($request) {
        $user = $request->user();
        if (!empty($request->user_id)) {
            $user = User::find($request->user_id);
        }

        $resident = 5;
        $user->user_type_id = $resident;
        $user->save();
    }
}
