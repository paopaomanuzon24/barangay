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
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()
            ], 400);
        }

        $checkData = PermitCategory::where("description",$request->description)->first();
        if(!empty($checkData)){
            return response()->json([
                'message' => "Category Exist."
            ], 201);
        }

        $permit = new PermitCategory;
        $permit->description = $request->description;
        $permit->save();

        return response()->json([
            'status' => 'success',
            'message' => "Category Added."
        ], 200);

    }

    public function show(Request $request, $id){

        $categoryData = PermitCategory::find($id);
        if(!empty($categoryData)){

            $data = $categoryData->toArray();
            return response()->json([
                    $data
            ], 200);
        }

    }

    public function edit(Request $request, $id){

        $categoryData = PermitCategory::find($id);
        if(!empty($categoryData)){

            $data = $categoryData->toArray();
            return response()->json([
                    $data
            ], 200);
        }

    }

    public function update(Request $request){

        $validator = Validator::make($request->all(),[
            'description' => 'required|string',
            'id' => 'required|integer|min:0'

        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()
            ], 400);
        }

        $categoryData = PermitCategory::find($request->id);
        $categoryData->description = $request->description;
        $categoryData->save();

        return response()->json([
            'status' => 'success',
            'message' => "Category Updated."
        ], 200);
    }

    public function delete(Request $request){

        $validator = Validator::make($request->all(),[
            'id' => 'required|integer|min:0'
        ]);


        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()
            ], 400);
        }

        $barangayData = PermitCategory::find($request->id);
        $barangayData->delete();
        return response()->json([
            'status' => 'success',
            'message' => "Category deleted."
        ], 201);

    }



    public function list(Request $request){

        $return = array();
        $barangayData = PermitCategory::all();
        foreach($barangayData as $row){
            $return[] = $row->getOriginal();
        }

        return response()->json($return);
    }
}
