<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


use Illuminate\Support\Facades\Storage;

use App\Models\PermitTemplate;
use App\Models\PermitFees;
use App\Models\PermitType;
use App\Models\PermitHistory;



class PermitGenerationController extends Controller
{

    public function generatePermit(Request $request){

        $this->validateGeneratePermit($request);

      /*   $templateData = PermitTemplate::find($request->template_id);

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
        } */

        $controlNumber = $this->getControlNumber();
        $data = [
            'template_id' => $request->template_id,
            'permit_type_id' => $request->permit_type_id,
            'barangay_id' => $request->barangay_id,
            'control_number' => $controlNumber
        ];
        PermitHistory::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Permit generated.'
        ], 200);
    }

    private function validateGeneratePermit($request){

        $validator = Validator::make($request->all(),[
            'template_id' => 'required|integer|min:0',
            'barangay_id' => 'required|integer|min:0',
            'permit_type_id' => 'required|integer|min:0',

        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()
            ], 400);
        }
    }

    private function getControlNumber(){
        return rand();
    }


}
