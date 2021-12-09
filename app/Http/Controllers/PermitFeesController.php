<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\PermitFees;
use Illuminate\Support\Facades\Storage;




class PermitFeesController extends Controller
{

    public function store(Request $request){


        $validator = Validator::make($request->all(),[
            'permit_type_id' => 'required|integer',
            'fee' => 'required|integer|min:0',
            'amendment' => 'required|string'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()
            ], 400);
        }


        $data = [
            'permit_type_id' => $request->permit_type_id,
            'fee' => $request->fee,
            'amendment' => $request->amendment
        ];
        PermitFees::create($data);


        return response()->json([
            'status' => 'success',
            'message' => "Permit Fees Added."
        ], 200);

    }

    public function update(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'id' => 'required|integer',
            'permit_type_id' => 'required|integer',
            'fee' => 'required|integer|min:0',
            'amendment' => 'required|string'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()
            ], 400);
        }


        $permitFee = PermitFees::find($id);
        $permitFee->permit_type_id = $request->permit_type_id;
        $permitFee->fee = $request->fee;
        $permitFee->amendment = $request->amendment;
        $permitFee->save();

        return response()->json([
            'status' => 'success',
            'message' => "Permit Fees Updated."
        ], 200);
    }

    public function edit(Request $request, $id){

        $permitFee = PermitFees::find($id);
        if(!empty($permitFee)){

            $data = $permitFee->toArray();
            return response()->json([
                    $data
            ], 200);
        }else{
            return response()->json([
                'error' => 'invalid payload',
                'message' => 'fee not found.'
            ], 400);
        }

    }




}
