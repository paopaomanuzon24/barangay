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
          #  'position_id' => 'required|integer|min:0',
           # 'photo' => 'mimes:jpg,bmp,png'
        ]);


        if($validator->fails()){
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $checkData = BarangayOfficial::profileByName($request->first_name,$request->middle_name,$request->last_name)->first();
        if(!empty($checkData)){
            return customResponse()
                ->data(null)
                ->message("Profile Exist")
                ->success()
                ->generate();
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
        $barangay->position_id = 0;
        $barangay->photo_file_name = "";
        $barangay->photo_path = "";
        $barangay->save();


        return customResponse()
            ->data(null)
            ->message("Barangay Official Added.")
            ->success()
            ->generate();




    }

    public function edit(Request $request, $id){

        $barangayData = BarangayOfficial::find($id);
        if(!empty($barangayData)){
          #  $path = $barangayData->photo_path;

           # $path = Storage::url($path);
            $data = $barangayData->toArray();
         #   $data['photo'] = $path;

            return customResponse()
            ->data($data)
            ->message("Barangay Official Data.")
            ->success()
            ->generate();
        }

    }

    public function update(Request $request){

        $validator = Validator::make($request->all(),[
            'first_name' => 'required|string',
            'middle_name' => 'required|string',
            'last_name' => 'required|string',
          #  'position_id' => 'required|integer|min:0',
            'id' => 'required|integer|min:0'

        ]);


        if($validator->fails()){


            return customResponse()
            ->data(null)
            ->message($validator->errors()->all()[0])
            ->failed()
            ->generate();
        }



        $barangay = BarangayOfficial::find($request->id);
        $barangay->first_name = $request->first_name;
        $barangay->middle_name = $request->middle_name;
        $barangay->last_name = $request->last_name;
       # $barangay->position_id = $request->position_id;
        $barangay->save();

       /*  return response()->json([
            'status' => 'success',
            'message' => "Profile Updated."
        ], 201); */

        return customResponse()
        ->data(null)
        ->message("Profile Updated.")
        ->success()
        ->generate();
    }

    public function show(Request $request, $id){

        $barangayData = BarangayOfficial::find($id);
        if(!empty($barangayData)){
          #  $path = $barangayData->photo_path;

           # $path = Storage::url($path);
            $data = $barangayData->toArray();
         #   $data['photo'] = $path;

           # return response()->json($data, 201);

            return customResponse()
            ->data($data)
            ->message("Barangay official data.")
            ->success()
            ->generate();
        }

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

        $barangayData = BarangayOfficial::find($request->id);
        $barangayData->delete();


        return customResponse()
            ->message("Barangay official deleted.")
            ->data(null)
            ->success()
            ->generate();

    }

    public function list(Request $request){

        $return = array();

        $barangayData = BarangayOfficial::all();
        foreach($barangayData as $row){
            $return[] = $row->getOriginal();
        }

        return customResponse()
            ->message("Barangay Official List")
            ->data($return)
            ->success()
            ->generate();

    }


}
