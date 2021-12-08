<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PermitType;

use Illuminate\Support\Facades\Storage;

use App\Models\PermitTemplate;
use App\Models\PermitFees;


class PermitController extends Controller
{

    public function savePermitType(Request $request){


        $validator = Validator::make($request->all(),[
            'permit_name' => 'required|string'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()
            ], 400);
        }

        $permit = new PermitType;
        $permit->permit_name = $request->permit_name;
        $permit->save();

        return response()->json([
            'status' => 'success',
            'message' => "Permit Added."
        ], 400);

    }

    public function getPermitList(Request $request){

        $permitData = PermitType::all();
        $return = array();
        foreach($permitData as $row){
            $return[$row->id] = $row->permit_name;
        }

        return response()->json($return);


    }

    public function generatePermit(Request $request){

        $this->validateGeneratePermit($request);

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

        return response()->json([
            'data' => $data
        ], 400);
    }

    private function validateGeneratePermit($request){

        $validator = Validator::make($request->all(),[
            'template_id' => 'required|integer',
            'barangay_id' => 'required|integer',
            'permit_type_id' => 'required|integer',
            'permit_fee_id' => 'required|integer'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()
            ], 400);
        }
    }


}
