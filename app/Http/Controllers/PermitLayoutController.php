<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\PermitLayout;
use App\Models\Barangay;
use App\Models\PermitTemplate;



class PermitLayoutController extends Controller
{

    public function editRequestLayout(Request $request,$id){
        $barangayData = Barangay::find($id);
        if(empty($barangayData)){
            return customResponse()
            ->data(null)
            ->message("Barangay not found.")
            ->failed()
            ->generate();
        }

        $layoutData = PermitLayout::where("barangay_id",$id)->first();
        $return = $layoutData->toArray();

        $return['barangay'] = $barangayData->description;

        return customResponse()
            ->data($return)
            ->message("Layout data.")
            ->failed()
            ->generate();

    }

    public function updateRequestLayout(Request $request){

        $validator = Validator::make($request->all(),[
            'barangay_id' => 'required|integer|min:1',
            'template_id' => 'required|integer|min:1',
            'signatory' => 'required|string',
            'barangay_position' => 'required|string',
            'barangay_address' => 'required|string',
            'barangay_hotline' => 'required|integer',
            'barangay_email' => 'required|email:rfc,dns'

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

        $templateData = PermitTemplate::find($request->template_id);
        if(empty($templateData)){
             return customResponse()
            ->data(null)
            ->message("Template not found.")
            ->failed()
            ->generate();
        }

        $layoutData = PermitLayout::where("barangay_id",$request->barangay_id)->first();
        if(empty($layoutData)){
            $layoutData = new PermitLayout;
            $layoutData->barangay_id = $request->barangay_id;
        }

        $layoutData->template_id = $request->template_id;

        $layoutData->signatory = $request->signatory;
        $layoutData->barangay_position = $request->barangay_position;
        $layoutData->barangay_address = $request->barangay_address;
        $layoutData->barangay_hotline = $request->barangay_hotline;
        $layoutData->barangay_email = $request->barangay_email;
        $layoutData->save();
        return customResponse()
            ->data(null)
            ->message("Layout saved.")
            ->success()
            ->generate();

    }


}
