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

    public function store(Request $request){


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
        ], 200);

    }

    public function edit(Request $request, $id){

        $permitTypeData = PermitType::find($id);
        if(!empty($permitTypeData)){

            $data = $permitTypeData->toArray();
            return response()->json([
                    $data
            ], 200);
        }

    }

    public function update(Request $request){

        $validator = Validator::make($request->all(),[
            'permit_name' => 'required|string',
            'id' => 'required|integer|min:0'

        ]);


        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()
            ], 400);
        }


        $permitFee = PermitType::find($id);
        $permitFee->permit_name = $request->permit_name;
        $permitFee->save();

        return response()->json([
            'status' => 'success',
            'message' => "Permit Type Updated."
        ], 200);
    }

    public function getPermitType(Request $request,$id){

        $request->merge(['id' => $id]);
        $validator = Validator::make($request->all(),[
            'id' => 'integer|min:0'
        ]);


        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()
            ], 400);
        }

        $permitData = PermitType::find($id);
        $return = $permitData->toArray();

        return response()->json($return,201);
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
        ], 200);
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
