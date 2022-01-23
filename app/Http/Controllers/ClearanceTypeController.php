<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Barangay;
use App\Models\ClearanceType;
use App\Models\ClearanceCategory;


class ClearanceTypeController extends Controller
{

    public function store(Request $request){


        $validator = Validator::make($request->all(),[
            'clearance_name' => 'required|string',
            'category_id' => 'required|integer|min:1',
            'barangay_id' => 'required|integer|min:1',
            'fee' => 'required|numeric|min:0'
        ]);

        if($validator->fails()){
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $categoryData = ClearanceCategory::find($request->category_id);
        if(empty($categoryData)){
            return customResponse()
                ->data(null)
                ->message("Category not found.")
                ->failed()
                ->generate();
        }

        $barangayData = Barangay::find($request->barangay_id);
        if(empty($barangayData)){
            return customResponse()
                ->data(null)
                ->message("Barangay not found.")
                ->failed()
                ->generate();
        }

        $clearanceData = ClearanceType::where("clearance_name",$request->clearance_name)->first();
        if(!empty($clearanceData)){
            return customResponse()
                ->data(null)
                ->message("Clearance type exist.")
                ->success()
                ->generate();
        }

        $clearanceData = new ClearanceType;
        $clearanceData->clearance_name = $request->clearance_name;
        $clearanceData->barangay_id = $request->barangay_id;
        $clearanceData->category_id = $request->category_id;
        $clearanceData->fee = $request->fee;
        $clearanceData->save();

        return customResponse()
                ->data(null)
                ->message("Clearance Type Added.")
                ->success()
                ->generate();

    }

    public function edit(Request $request, $id){




        $clearanceData = ClearanceType::find($id);
        if(!empty($clearanceData)){
            return customResponse()
                ->data($clearanceData)
                ->message("Clearance Type Data.")
                ->success()
                ->generate();
        }else{
            return customResponse()
                ->data(null)
                ->message("Clearance not found.")
                ->failed()
                ->generate();
        }

    }

    public function update(Request $request){

        $validator = Validator::make($request->all(),[
            'clearance_name' => 'required|string',
            'id' => 'required|integer|min:1',
            'barangay_id' => 'required|integer|min:1',
            'category_id' => 'required|integer|min:1',
            'fee' => 'required|numeric|min:0'
        ]);


        if($validator->fails()){
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $barangayData = Barangay::find($request->barangay_id);
        if(empty($barangayData)){
            return customResponse()
                ->data(null)
                ->message("Barangay not found.")
                ->failed()
                ->generate();
        }

        $categoryData = ClearanceCategory::find($request->category_id);
        if(empty($categoryData)){
            return customResponse()
                ->data(null)
                ->message("Category not found.")
                ->failed()
                ->generate();
        }

        $clearanceData = ClearanceType::where("clearance_name",$request->clearance_name)->first();
        if(!empty($clearanceData)){
            return customResponse()
                ->data(null)
                ->message("Clearance type exist.")
                ->success()
                ->generate();
        }


        $clearanceData = ClearanceType::find($request->id);
        if(!empty($clearanceData)){
            $clearanceData->clearance_name = $request->clearance_name;
            $clearanceData->barangay_id = $request->barangay_id;
            $clearanceData->category_id = $request->category_id;
            $clearanceData->fee = $request->fee;
            $clearanceData->save();
            return customResponse()
            ->data(null)
            ->message("Clearance updated.")
            ->success()
            ->generate();
        }else{
            return customResponse()
            ->data(null)
            ->message("Clearance not found.")
            ->failed()
            ->generate();
        }





    }

    public function delete(Request $request){

        $validator = Validator::make($request->all(),[
            'id' => 'required|integer|min:1'
        ]);


        if($validator->fails()){
            return customResponse()
            ->data(null)
            ->message($validator->errors()->all()[0])
            ->failed()
            ->generate();
        }

        $clearanceData = ClearanceType::find($request->id);
        if(!empty($clearanceData)){
            $clearanceData->delete();
            return customResponse()
            ->data(null)
            ->message("Clearance Type deleted.")
            ->success()
            ->generate();
        }else{
            return customResponse()
            ->data(null)
            ->message("Clearance not found")
            ->failed()
            ->generate();
        }

    }



    public function list(Request $request){

        $clearanceData = ClearanceType::where("clearance_name","!=","");
        if(!empty($request['barangay_id'])){
            $clearanceData = $clearanceData->where("barangay_id",$request['barangay_id']);
        }

        if(!empty($request['category_id'])){
            $clearanceData = $clearanceData->where("category_id",$request['category_id']);
        }

        $clearanceData = $clearanceData->get();

        return customResponse()
            ->data($clearanceData)
            ->message("Clearance type list.")
            ->success()
            ->generate();
    }

    public function show(Request $request, $id){

        $clearanceData = ClearanceType::find($id);
        if(!empty($clearanceData)){
            return customResponse()
                ->data($clearanceData)
                ->message("Clearance type data.")
                ->success()
                ->generate();
        }else{
            return customResponse()
                ->data(null)
                ->message("Clearance type not found.")
                ->failed()
                ->generate();
        }

    }


}
