<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PermitType;

use Illuminate\Support\Facades\Storage;

use App\Models\PermitTemplate;
use App\Models\PermitFees;
use App\Models\BarangayOfficial;


class BarangayOfficialController extends Controller
{

    public function store(Request $request){


        $validator = Validator::make($request->all(),[
            'first_name' => 'required|string',
            'middle_name' => 'required|string',
            'last_name' => 'required|string',
            'position_id' => 'required|integer|min:0',
           # 'photo' => 'mimes:jpg,bmp,png'
        ]);


        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()
            ], 400);
        }

        $checkData = BarangayOfficial::profileByName($request->first_name,$request->middle_name,$request->last_name)->first();
        if(!empty($checkData)){
            return response()->json([
                'message' => "Profile Exist."
            ], 201);
        }
/*
        if($request->hasFile('photo')){
            $path = 'images/barangay/officials';

            $image = $request->file('photo');
            $imageName = $image->getClientOriginalName();

            $request->file('photo')->storeAs("public/".$path,$imageName);


            $data['file_name'] = $imageName;
            $data['path_name'] = $path.'/'.$imageName;
        } */

        $barangay = new BarangayOfficial;
        $barangay->first_name = $request->first_name;
        $barangay->middle_name = $request->middle_name;
        $barangay->last_name = $request->last_name;
        $barangay->position_id = $request->position_id;
     #   $barangay->photo_file_name = $imageName;
      #  $barangay->photo_path = $path.'/'.$imageName;
        $barangay->save();

        return response()->json([
            'status' => 'success',
            'message' => "Barangay Official Added ."
        ], 200);

    }

    public function edit(Request $request, $id){

        $barangayData = BarangayOfficial::find($id);
        if(!empty($barangayData)){
          #  $path = $barangayData->photo_path;

           # $path = Storage::url($path);
            $data = $barangayData->toArray();
         #   $data['photo'] = $path;

            return response()->json($data, 201);
        }

    }

    public function update(Request $request){

        $validator = Validator::make($request->all(),[
            'first_name' => 'required|string',
            'middle_name' => 'required|string',
            'last_name' => 'required|string',
            'position_id' => 'required|integer|min:0',
            'id' => 'required|integer|min:0'

        ]);


        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()
            ], 400);
        }



        $barangay = BarangayOfficial::find($request->id);
        $barangay->first_name = $request->first_name;
        $barangay->middle_name = $request->middle_name;
        $barangay->last_name = $request->last_name;
        $barangay->position_id = $request->position_id;
        $barangay->save();

        return response()->json([
            'status' => 'success',
            'message' => "Profile Updated."
        ], 201);
    }

    public function show(Request $request, $id){

        $barangayData = BarangayOfficial::find($id);
        if(!empty($barangayData)){
          #  $path = $barangayData->photo_path;

           # $path = Storage::url($path);
            $data = $barangayData->toArray();
         #   $data['photo'] = $path;

            return response()->json($data, 201);
        }

    }



}
