<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Barangay;
use App\Models\ClearanceCategory;
use App\Models\ClearanceType;


class ClearanceCategoryController extends Controller
{

    public function store(Request $request){


        $validator = Validator::make($request->all(),[
            'description' => 'required|string',
            'barangay_id' => 'required|integer|min:1'
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

        $checkData = ClearanceCategory::where("description",$request->description)
            ->where("barangay_id", $request->barangay_id)
            ->first();
        if(!empty($checkData)){
            return customResponse()
                ->data(null)
                ->message("Clearance category exist.")
                ->failed()
                ->generate();
        }

        $category = new ClearanceCategory;
        $category->description = $request->description;
        $category->barangay_id = $request->barangay_id;
        $category->save();


        return customResponse()
            ->data(null)
            ->message("Clearance Category Added.")
            ->success()
            ->generate();



    }

    public function show(Request $request, $id){

        $categoryData = ClearanceCategory::find($id);
        if(!empty($categoryData)){
            return customResponse()
                ->data($categoryData)
                ->message("Clearance Category List.")
                ->success()
                ->generate();
        }

    }

    public function edit(Request $request, $id){



        $categoryData = ClearanceCategory::find($id);
        if(!empty($categoryData)){
            return customResponse()
                ->data($categoryData)
                ->message("Clearance Category Data.")
                ->success()
                ->generate();
        }else{
            return customResponse()
                ->data(null)
                ->message("Clearance Category not found.")
                ->failed()
                ->generate();
        }

    }

    public function update(Request $request){

        $validator = Validator::make($request->all(),[
            'description' => 'required|string',
            'id' => 'required|integer|min:1',
            'barangay_id' => 'required|integer|min:1'

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

        $categoryData = ClearanceCategory::where("description",$request->description)
            ->where("barangay_id", $request->barangay_id)
            ->first();
        if(!empty($categoryData)){
            return customResponse()
            ->data(null)
            ->message("Clearance Category Exist.")
            ->success()
            ->generate();
        }

        $categoryData = ClearanceCategory::find($request->id);
        if(!empty($categoryData)){
            $categoryData->description = $request->description;
            $categoryData->barangay_id = $request->barangay_id;
            $categoryData->save();
            return customResponse()
            ->data(null)
            ->message("Clearance Category Updated.")
            ->success()
            ->generate();
        }else{
            return customResponse()
            ->data(null)
            ->message("Clearance Category not found.")
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
        $clearanceTypeData = ClearanceType::where("category_id",$request->id)->first();
        if(!empty($clearanceTypeData)){
            return customResponse()
            ->data(null)
            ->message("Clearance category is being used.")
            ->failed()
            ->generate();
        }

        $clearanceData = ClearanceCategory::find($request->id);
        if(!empty($clearanceData)){
            $clearanceData->delete();
            return customResponse()
            ->data(null)
            ->message("Clearance category deleted.")
            ->success()
            ->generate();
        }else{
            return customResponse()
            ->data(null)
            ->message("Clearance category not found.")
            ->failed()
            ->generate();
        }
    }



    public function list(Request $request){


        $categoryData = ClearanceCategory::where("description","!=","");
        if(!empty($request['barangay_id'])){
            $categoryData = $categoryData->where("barangay_id",$request->barangay_id);
        }


        $categoryData = $categoryData->get();
        if(empty($categoryData)){
            return customResponse()
            ->data(null)
            ->message("No clearance category found")
            ->success()
            ->generate();
        }


        return customResponse()
            ->data($categoryData)
            ->message("Clearance category list.")
            ->success()
            ->generate();

        #return response()->json($return);
    }
}
