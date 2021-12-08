<?php

namespace App\Classes\Permit;


use Illuminate\Support\Facades\Storage;
use App\Models\PermitType;
use App\Models\PermitTemplate;
use App\Models\PermitFees;

class PermitGenerationClass
{

    public function getPermitData($request){



        $templateData = PermitTemplate::find($request->template_id);

        if(empty($templateData)){
            return response()->json([
                'error' => 'invalid',
                'message' => "Template not found."
            ], 400);
        }
        $typeData = PermitType::find($request->permit_type_id);
        if(empty($typeData)){
            return response()->json([
                'error' => 'invalid',
                'message' => "Permit type not found."
            ], 400);
        }
        $feeData = PermitFees::find($request->permit_fee_id);
        if(empty($feeData)){
            return response()->json([
                'error' => 'invalid',
                'message' => "Permit Fee not found."
            ], 400);
        }

        $controlNumber = rand();
        $data = [
            'template' => Storage::url($templateData->path_name),
            'permitType' => $typeData->permit_name,
            'fee' => $feeData->fee,
            'control_number' => $controlNumber
        ];

        return $data;
    }



}
