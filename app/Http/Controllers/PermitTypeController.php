<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PermitType;

use Illuminate\Support\Facades\Storage;

use App\Models\PermitTemplate;
use App\Models\PermitFees;


class PermitTypeController extends Controller
{

    public function store(Request $request){


        $validator = Validator::make($request->all(),[
            'permit_name' => 'required|string',
            'category_id' => 'required|integer|min:0',
            'barangay_id' => 'required|integer|min:0'
        ]);

        if($validator->fails()){
           /*  return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()
            ], 400); */
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $permit = PermitType::where("permit_name",$request->permit_name)->first();
        if(!empty($permit)){
            /* return response()->json([
                'message' => "Permit Type Exist."
            ], 201); */

            return customResponse()
                ->data(null)
                ->message("Permit type exist.")
                ->success()
                ->generate();
        }

        $permit = new PermitType;
        $permit->permit_name = $request->permit_name;
        $permit->category_id = $request->category_id;
        $permit->barangay_id = $request->barangay_id;
        $permit->save();

      /*   return response()->json([
            'status' => 'success',
            'message' => "Permit Added."
        ], 200); */

        return customResponse()
                ->data(null)
                ->message("Permit category Added.")
                ->success()
                ->generate();

    }

    public function edit(Request $request, $id){

        $permitTypeData = PermitType::find($id);
        if(!empty($permitTypeData)){

            $data = $permitTypeData->toArray();


            return customResponse()
                ->data($data)
                ->message("Permit Type Data.")
                ->success()
                ->generate();
        }

    }

    public function update(Request $request){

        $validator = Validator::make($request->all(),[
            'permit_name' => 'required|string',
            'id' => 'required|integer|min:0',
            'category_id' => 'required|integer|min:0',
            'barangay_id' => 'required|integer|min:0'

        ]);


        if($validator->fails()){

            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }


        $permit = PermitType::find($request->id);
        $permit->permit_name = $request->permit_name;
        $permit->category_id = $request->category_id;
        $permit->barangay_id = $request->barangay_id;
        $permit->save();



        return customResponse()
            ->data(null)
            ->message("Permit type updated")
            ->success()
            ->generate();
    }

    public function delete(Request $request){

        $validator = Validator::make($request->all(),[
            'id' => 'required|integer|min:0'
        ]);


        if($validator->fails()){
            return customResponse()
            ->data(null)
            ->message($validator->errors()->all()[0])
            ->failed()
            ->generate();
        }

        $barangayData = PermitType::find($request->id);
        $barangayData->delete();


        return customResponse()
            ->data(null)
            ->message("Permit type deleted.")
            ->success()
            ->generate();

    }



    public function getPermitType(Request $request,$id){

        $request->merge(['id' => $id]);
        $validator = Validator::make($request->all(),[
            'id' => 'integer|min:0'
        ]);


        if($validator->fails()){
            return customResponse()
            ->data(null)
            ->message($validator->errors()->all()[0])
            ->failed()
            ->generate();
        }

        $permitData = PermitType::find($id);
        #$return = $permitData->toArray();

        return customResponse()
        ->data($permitData)
        ->message("Permit Type Data.")
        ->failed()
        ->generate();

      #  return response()->json($return,201);
    }

    public function list(Request $request){

        $permitData = PermitType::all();
        $return = array();
        foreach($permitData as $row){
            $return[$row->id] = $row->getOriginal();
        }

        return customResponse()
            ->data($return)
            ->message("Permit type list.")
            ->success()
            ->generate();
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
