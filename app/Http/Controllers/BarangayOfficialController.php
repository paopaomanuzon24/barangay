<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;
use App\Models\BarangayOfficial;
use App\Models\BarangayPosition;
use App\Models\Barangay;

class BarangayOfficialController extends Controller
{

    public function store(Request $request){


        $validator = Validator::make($request->all(),[
            'first_name' => 'required|string',
            'middle_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'contact_no'=>'required',
            'position_id' => 'required|integer|min:1',
            'barangay_id' => 'required|integer|min:1',
            'photo' => 'mimes:jpg,bmp,png'
        ]);


        if($validator->fails()){
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $positionData = BarangayPosition::find($request->position_id);
        if(empty($positionData)){
            return customResponse()
                ->data(null)
                ->message("Position not found.")
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

        $checkData = BarangayOfficial::profileByName($request->first_name,$request->middle_name,$request->last_name)->first();
        if(!empty($checkData)){
            return customResponse()
                ->data(null)
                ->message("Profile Exist")
                ->success()
                ->generate();
        }
        $path = "";
        $imageName = "";



        $barangay = new BarangayOfficial;
        $barangay->first_name = $request->first_name;
        $barangay->middle_name = $request->middle_name;
        $barangay->last_name = $request->last_name;
        $barangay->barangay_id = $request->barangay_id;
        $barangay->position_id = $request->position_id;
        $barangay->contact_no = $request->contact_no;
        $barangay->address = $request->address;

        $barangay->save();

        if($request->hasFile('photo')){

            $path = 'public/images/barangay_officials';
            if(is_array($request->file('photo'))){
                $image = $request->file('photo')[0];
            }else{
                $image = $request->file('photo');
            }

            $imageExtension = $image->getClientOriginalExtension();

            $imageName = "official_".$request->barangay_id.'_'.$barangay->id.'.'.$imageExtension;

            if(is_array($request->file('photo'))){
                $request->file('photo')[0]->storeAs($path,$imageName);
            }else{
                $request->file('photo')->storeAs($path,$imageName);
            }
        }
        $barangayPhoto = BarangayOfficial::find($barangay->id);
        $barangayPhoto->file_name = $imageName;
        $barangayPhoto->file_path = $path;
        $barangayPhoto->save();




        return customResponse()
            ->data(null)
            ->message("Barangay Official Added.")
            ->success()
            ->generate();
    }

    public function edit(Request $request, $id){

        $barangayData = BarangayOfficial::find($id);
        if(!empty($barangayData)){
            $photo = "";
            if(!empty($barangayData->file_path)){
                $photo = $barangayData->file_path.'/'.$barangayData->file_name;
                $photo = Storage::url($photo);
            }
            $data = array(
                'id' => $barangayData->id,
                'first_name' => $barangayData->first_name,
                'middle_name' => $barangayData->middle_name,
                'last_name' => $barangayData->last_name,
                'position_id' => $barangayData->position_id,
                'barangay_id' => $barangayData->barangay_id,
                'address' => $barangayData->address,
                'contact_no' => $barangayData->contact_no,
                'photo' => $photo,
                'created_at' => $barangayData->created_at,
            );


            return customResponse()
            ->data($data)
            ->message("Barangay Official Data.")
            ->success()
            ->generate();
        }else{
            return customResponse()
            ->data(null)
            ->message("Barangay data not found.")
            ->success()
            ->generate();
        }

    }

    public function update(Request $request){



        $validator = Validator::make($request->all(),[
            'id' => 'required|integer|min:1',
            'first_name' => 'required|string',
            'middle_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'contact_no'=>'required',
            'position_id' => 'required|integer|min:1',
            'barangay_id' => 'required|integer|min:1',
       #     'photo' => 'mimes:jpg,bmp,png'
        ]);


        if($validator->fails()){
            return customResponse()
            ->data(null)
            ->message($validator->errors()->all()[0])
            ->failed()
            ->generate();
        }

        $positionData = BarangayPosition::find($request->position_id);
        if(empty($positionData)){
            return customResponse()
                ->data(null)
                ->message("Position not found.")
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


        $officialData = BarangayOfficial::find($request->id);
        if(!empty($officialData)){
            if(!empty($officialData->file_path) && !empty($officialData->file_name)){
                Storage::delete($officialData->file_path.'/'.$officialData->file_name);
            }

        }
        if($request->hasFile('photo')){

            $path = 'public/images/barangay_officials';
            if(is_array($request->file('photo'))){
                $image = $request->file('photo')[0];
            }else{
                $image = $request->file('photo');
            }
            $imageExtension = $image->getClientOriginalExtension();

            $imageName = "official_".$request->barangay_id.'_'.$request->id.'.'.$imageExtension;

            if(is_array($request->file('photo'))){
                $request->file('photo')[0]->storeAs($path,$imageName);
            }else{
                $request->file('photo')->storeAs($path,$imageName);
            }
        }




        if(!empty($officialData)){


            $officialData->first_name = $request->first_name;
            $officialData->middle_name = $request->middle_name;
            $officialData->last_name = $request->last_name;
            $officialData->position_id = $request->position_id;
            $officialData->barangay_id = $request->barangay_id;
            $officialData->contact_no = $request->contact_no;
            $officialData->address = $request->address;
            if(!empty($imageName)){
                $officialData->file_name = $imageName;
            }

            if(!empty($path)){
                $officialData->file_path = $path;
            }

            $officialData->save();

            return customResponse()
            ->data(null)
            ->message("Barangay official Updated.")
            ->success()
            ->generate();
        }else{
            return customResponse()
            ->data(null)
            ->message("Barangay official not found.")
            ->failed()
            ->generate();
        }
    }

    public function show(Request $request, $id){

        $barangayData = BarangayOfficial::find($id);
        if(!empty($barangayData)){
            $photo = "";
            if(!empty($barangayData->file_path)){
                $photo = $barangayData->file_path.'/'.$barangayData->file_name;
                $photo = Storage::url($photo);
            }
            $data = array(
                'id' => $barangayData->id,
                'first_name' => $barangayData->first_name,
                'middle_name' => $barangayData->middle_name,
                'last_name' => $barangayData->last_name,
                'position_id' => $barangayData->position_id,
                'barangay_id' => $barangayData->barangay_id,
                'address' => $barangayData->address,
                'contact_no' => $barangayData->contact_no,
                'photo' => $photo,
                'created_at' => $barangayData->created_at,
            );

            return customResponse()
            ->data($data)
            ->message("Barangay official data.")
            ->success()
            ->generate();
        }else{
            return customResponse()
            ->data(null)
            ->message("Barangay official not found.")
            ->failed()
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
            ->message("Barangay official not found.")
            ->failed()
            ->generate();
        }

        $barangayData = BarangayOfficial::find($request->id);
        if(!empty($barangayData)){
            Storage::delete($barangayData->file_path.'/'.$barangayData->file_name);
            $barangayData->delete();
            return customResponse()
            ->message("Barangay official deleted.")
            ->data(null)
            ->success()
            ->generate();
        }else{
            return customResponse()
            ->message("Barangay official not found.")
            ->data(null)
            ->failed()
            ->generate();
        }


    }

    public function list(Request $request){

        $return = array();

        $barangayData = BarangayOfficial::with('position','barangay');
        if(!empty($request->barangay_id)){
            $barangayData = $barangayData->where("barangay_id",$request->barangay_id);
        }
        $barangayData = $barangayData->get();
        foreach($barangayData as $row){

            $photo = "";
            if(!empty($row->file_path) && !empty($row->file_name)){
                $photo = $row->file_path.'/'.$row->file_name;
                $photo = Storage::url($photo);
            }
            $data[] = array(
                'id' => $row->id,
                'first_name' => $row->first_name,
                'middle_name' => $row->middle_name,
                'last_name' => $row->last_name,
                'position' => $row->position->description,
                'barangay_id' => $row->barangay->description,
                'address' => $row->address,
                'contact_no' => $row->contact_no,
                'photo' => $photo,
                'created_at' => $row->created_at,
            );
        }

        return customResponse()
            ->message("Barangay Official List")
            ->data($data)
            ->success()
            ->generate();

    }


}
