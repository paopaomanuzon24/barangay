<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PermitCategory;


class PermitCategoryController extends Controller
{

    public function store(Request $request){


        $validator = Validator::make($request->all(),[
            'description' => 'required|string',
            'barangay_id' => 'required|integer|min:0'
        ]);

        if($validator->fails()){
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $checkData = PermitCategory::where("description",$request->description)
            ->where("barangay_id", $request->barangay_id)
            ->first();
        if(!empty($checkData)){
            return customResponse()
                ->data(null)
                ->message("Permit category exist.")
                ->success()
                ->generate();
        }

        $permit = new PermitCategory;
        $permit->description = $request->description;
        $permit->barangay_id = $request->barangay_id;
        $permit->save();


        return customResponse()
            ->data(null)
            ->message("Permit Category Added.")
            ->success()
            ->generate();



    }

    public function show(Request $request, $id){

        $categoryData = PermitCategory::find($id);
        if(!empty($categoryData)){
            return customResponse()
                ->data($categoryData)
                ->message("Permit Category List.")
                ->success()
                ->generate();
        }

    }

    public function edit(Request $request, $id){

        $categoryData = PermitCategory::find($id);

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
        if(!empty($categoryData)){
            return customResponse()
                ->data($categoryData)
                ->message("Permit Category Data.")
                ->success()
                ->generate();
        }

    }

    public function update(Request $request){

        $validator = Validator::make($request->all(),[
            'description' => 'required|string',
            'id' => 'required|integer|min:0',
            'barangay_id' => 'required|integer|min:0'

        ]);

        if($validator->fails()){
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }
        $categoryData = PermitCategory::where("description",$request->description)
            ->where("barangay_id", $request->barangay_id)
            ->first();
        if(!empty($categoryData)){
            return customResponse()
            ->data(null)
            ->message("Permit Category Exist.")
            ->success()
            ->generate();
        }

        $categoryData = PermitCategory::find($request->id);
        $categoryData->description = $request->description;
        $categoryData->barangay_id = $request->barangay_id;
        $categoryData->save();


        return customResponse()
            ->data(null)
            ->message("Permit Category Updated.")
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

        $barangayData = PermitCategory::find($request->id);
        $barangayData->delete();


        return customResponse()
            ->data(null)
            ->message("Permit category deleted.")
            ->success()
            ->generate();

    }



    public function list(Request $request){


        $categoryData = PermitCategory::fromBarangaySystem();
        if(!empty($request['barangay_id'])){
            $categoryData = $categoryData->where("barangay_id",$request->barangay_id);
        }

        $categoryData = $categoryData->get();
        if(!empty($categoryData)){
            $return = array();
            foreach($categoryData as $row){
                $return[] = array(
                    'id' => $row->id,
                    'description' => $row->description,
                    'barangay_id' => $row->barangay_id,
                );
            }
            return customResponse()
            ->data($return)
            ->message("Permit category list.")
            ->success()
            ->generate();
        }else{
            return customResponse()
            ->data(null)
            ->message("No permit category found")
            ->success()
            ->generate();
        }





        #return response()->json($return);
    }
}
