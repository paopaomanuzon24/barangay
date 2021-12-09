<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PermitTemplate;
use Illuminate\Support\Facades\Storage;




class PermitTemplateController extends Controller
{

    public function store(Request $request){

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


            $data['file_name'] = $imageName;
            $data['path_name'] = $path.'/'.$imageName;
            PermitTemplate::create($data);




            return response()->json([
                'status' => 'success',
                'message' => "Permit Template Added."
            ], 400);
        }
    }


    public function show(Request $request,$id){

        $template = PermitTemplate::find($id);
        if(!empty($tempate)){
            $path = $template->path_name;

            $path = Storage::url($path);
            return response()->json([
                'path' => $path,
            ], 400);
        }
    }

    public function edit(Request $request,$id){

        $template = PermitTemplate::find($id);
        if(!empty($tempate)){
            $path = $template->path_name;

            $path = Storage::url($path);
            return response()->json([
                'path' => $path,
            ], 201);
        }
    }

    /* public function update(Request $request){

        $validator = Validator::make($request->all(),[
            'template' => 'mimes:jpg,bmp,png|required',
            'id' => 'required|integer|min:0'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()
            ], 400);
        }

        if($request->hasFile('template')){
            Storage::delete("images/permit/template/Cedula.jpg");
            $path = 'images/permit/template';

            $image = $request->file('template');
            $imageName = $image->getClientOriginalName();

            $request->file('template')->storeAs("public/".$path,$imageName);


            $template = PermitTemplate::where("id",$request->id)->first();

            $currentImageSaved = Storage::url("");
            dd($currentImageSaved,$template->path_name);
           # $currentImageSaved = $currentImageSaved);
            Storage::delete($template->path_name);


            $template->file_name = $imageName;
            $template->path_name = $path.'/'.$imageName;
            $template->save();




            return response()->json([
                'status' => 'success',
                'message' => "Permit Template Added."
            ], 400);
        }
    } */


}
