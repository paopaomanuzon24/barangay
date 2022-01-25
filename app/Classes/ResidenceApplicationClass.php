<?php

namespace App\Classes;

use Carbon\Carbon;

use App\Models\PersonalData;
use App\Models\Barangay;
use App\Models\BarangayIDSequence;
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

        $this->generateResidentID($request);
    }

    protected function generateResidentID($request) {
        $user = $request->user();
        if (!empty($request->user_id)) {
            $user = User::find($request->user_id);
        }

        $barangayData = Barangay::find($user->barangay_id);

        $seqData = BarangayIDSequence::where("barangay_id", $user->barangay_id)->where("current_year", date('Y'))->first();
        if (empty($seqData)) {
            $seqData = new BarangayIDSequence;
            $seqData->barangay_id = $user->barangay_id;
            $seqData->current_year = date('Y');
            $seqData->sequence = 0;
        }

        $defSeq = "00000000";
        $sequence = $seqData->sequence + 1;
        $newSequence = substr($defSeq, strlen($sequence)) . $sequence;

        $seqData->sequence = $sequence;
        $seqData->save();

        $residentID = $barangayData->code . $seqData->current_year . $newSequence;

        $personalData = PersonalData::where("user_id", $user->id)->first();
        $personalData->resident_id = $residentID;
        $personalData->save();
        
    }
}
