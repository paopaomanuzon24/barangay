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
            'barangay_id' => 'required|integer|min:0',
            'fee' => 'required|numeric|min:0'
        ]);

        if($validator->fails()){
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $permit = PermitType::where("permit_name",$request->permit_name)
            ->where("barangay_id", $request->barangay_id)
            ->first();
        if(!empty($permit)){
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
        $permit->fee = $request->fee;
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
            return customResponse()
                ->data($permitTypeData)
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
            'barangay_id' => 'required|integer|min:0',
            'fee' => 'required|numeric|min:0'

        ]);


        if($validator->fails()){
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }


        $permit = PermitType::find($request->id);
        if(!empty($permit)){
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
        if(!empty($barangayData)){
            $barangayData->delete();
            return customResponse()
            ->data(null)
            ->message("Permit type deleted.")
            ->success()
            ->generate();
        }

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


        return customResponse()
        ->data($permitData)
        ->message("Permit Type Data.")
        ->failed()
        ->generate();


    }

    public function list(Request $request){

        $permitData = PermitType::fromBarangaySystem();
        if(!empty($request['barangay_id'])){
            $permitData = $permitData->where("barangay_id",$request['barangay_id']);
        }
        if(!empty($request['category_id'])){
            $permitData = $permitData->where("category_id",$request['category_id']);
        }

        $permitData = $permitData->get();

        if(!empty($permitData)){
            $return = array();
            foreach($permitData as $row){
                $return[] = array(
                    'id' => $row->id,
                    'permit_name' => $row->permit_name,
                    'barangay_id' => $row->barangay_id,
                    'fee' => $row->fee
                );
            }

            return customResponse()
                ->data($return)
                ->message("Permit type list.")
                ->success()
                ->generate();
        }else{
            return customResponse()
                ->data(null)
                ->message("Permit type not found.")
                ->success()
                ->generate();
        }

    }

    public function show(Request $request, $id){

        $permitTypeData = PermitType::find($id);
        if(!empty($permitTypeData)){
            return customResponse()
                ->data($permitTypeData)
                ->message("Permit type data.")
                ->success()
                ->generate();
        }

    }


}
