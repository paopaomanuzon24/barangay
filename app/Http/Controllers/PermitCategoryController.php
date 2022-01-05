<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PermitCategory;


class PermitCategoryController extends Controller
{

    public function store(Request $request){


        $validator = Validator::make($request->all(),[
            'description' => 'required|string'
        ]);

        if($validator->fails()){
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $checkData = PermitCategory::where("description",$request->description)->first();
        if(!empty($checkData)){


            return customResponse()
                ->data(null)
                ->message("Permit category exist.")
                ->success()
                ->generate();
        }

        $permit = new PermitCategory;
        $permit->description = $request->description;
        $permit->save();


        return customResponse()
            ->data(null)
            ->message("Permit Category Added.")
            ->success()
            ->generate();

      /*   return response()->json([
            'status' => 'success',
            'message' => "Category Added."
        ], 200); */

    }

    public function show(Request $request, $id){

        $categoryData = PermitCategory::find($id);
        if(!empty($categoryData)){

            $data = $categoryData->toArray();
            /* return response()->json([
                    $data
            ], 200); */

            return customResponse()
                ->data($data)
                ->message("Permit Category List.")
                ->success()
                ->generate();
        }

    }

    public function edit(Request $request, $id){

        $categoryData = PermitCategory::find($id);
        if(!empty($categoryData)){

            $data = $categoryData->toArray();
           /*  return response()->json([
                    $data
            ], 200); */

            return customResponse()
                ->data($data)
                ->message("Permit Category Data.")
                ->success()
                ->generate();
        }

    }

    public function update(Request $request){

        $validator = Validator::make($request->all(),[
            'description' => 'required|string',
            'id' => 'required|integer|min:0'

        ]);

        if($validator->fails()){
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $categoryData = PermitCategory::find($request->id);
        $categoryData->description = $request->description;
        $categoryData->save();

       /*  return response()->json([
            'status' => 'success',
            'message' => "Category Updated."
        ], 200); */

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

        $return = array();
        $barangayData = PermitCategory::all();
        foreach($barangayData as $row){
            $return[] = $row->getOriginal();
        }

        return customResponse()
            ->data($return)
            ->message("Permit category list.")
            ->success()
            ->generate();

        #return response()->json($return);
    }
}
