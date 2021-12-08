<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PermitTemplate;
use Illuminate\Support\Facades\Storage;




class PermitTemplateController extends Controller
{

    public function savePermitTemplate(Request $request){

        $validator = Validator::make($request->all(),[
            'template' => 'mimes:jpg,bmp,png|required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()
            ], 400);
        }

        if($request->hasFile('template')){
            $path = 'images/permit/template';

            $image = $request->file('template');
            $imageName = $image->getClientOriginalName();

            $request->file('template')->storeAs("public/".$path,$imageName);

            if(!empty($request->id)){
                $template = PermitTemplate::where("id",$request->id)->first();
                $template->file_name = $imageName;
                $template->path_name = $path.'/'.$imageName;
                $template->save();
            }else{
                $data['file_name'] = $imageName;
                $data['path_name'] = $path.'/'.$imageName;
                PermitTemplate::create($data);
            }



            return response()->json([
                'status' => 'success',
                'message' => "Permit Template Added."
            ], 400);
        }
    }


    public function getTemplate(Request $request){

        $template = PermitTemplate::find($request->id);
        if(!empty($tempate)){
            $path = $template->path_name;

            $path = Storage::url($path);
            return response()->json([
                'path' => $path,
            ], 400);
        }else{
            return response()->json([
                'error' => 'invalid payload',
                'message' =>'template not found.'
            ], 400);
        }
    }

    public function generatePermit(Request $request){
        #store template
        #store layout
        #control number
        #barangay
        #permit type
        #permit fee

    }
}
