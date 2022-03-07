<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\ClearanceType;
use App\Models\ClearanceCategory;
use App\Models\ClearancePurpose;

class ClearancePurposeController extends Controller
{

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'clearance_type_id' => 'required|integer|min:1',
            'clearance_category_id' => 'required|integer|min:1',
            'barangay_id' => 'required|integer|min:1',
        ]);

        if($validator->fails()){
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $clearanceTypeData = ClearanceType::find($request->clearance_type_id);
        if(empty($clearanceTypeData)){
            return customResponse()
            ->data(null)
            ->message("Clearance type not found.")
            ->failed()
            ->generate();
        }

        $categoryData = ClearanceCategory::find($request->clearance_category_id);
        if(empty($categoryData)){
            return customResponse()
            ->data(null)
            ->message("Clearance category not found.")
            ->failed()
            ->generate();
        }

        $data = [

            'clearance_type_id' => $request->clearance_type_id,
            'clearance_category_id' => $request->clearance_category_id,
            'barangay_id' => $request->barangay_id,
            'purpose' => $request->purpose,
            'created_by' => Auth::user()->id

         ];
        ClearancePurpose::create($data);


        return customResponse()
        ->data(null)
        ->message("Clearance purpose created.")
        ->success()
        ->generate();

    }

    public function edit(Request $request, $id){

        $purposeData = ClearancePurpose::find($id);
        if(!empty($purposeData)){
            return customResponse()
                ->data($purposeData)
                ->message("Clearance Purpose Data.")
                ->success()
                ->generate();
        }else{
            return customResponse()
                ->data(null)
                ->message("Clearance purpose not found.")
                ->failed()
                ->generate();
        }

    }

    public function update(Request $request){

        $validator = Validator::make($request->all(),[
            'clearance_type_id' => 'required|integer|min:1',
            'clearance_category_id' => 'required|integer|min:1',
            'barangay_id' => 'required|integer|min:1',
            'id' => 'required|integer|min:1',
        ]);

        if($validator->fails()){
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $clearanceTypeData = ClearanceType::find($request->clearance_type_id);
        if(empty($clearanceTypeData)){
            return customResponse()
            ->data(null)
            ->message("Clearance type not found.")
            ->failed()
            ->generate();
        }

        $categoryData = ClearanceCategory::find($request->clearance_category_id);
        if(empty($categoryData)){
            return customResponse()
            ->data(null)
            ->message("Clearance category not found.")
            ->failed()
            ->generate();
        }

        $data = [
            # 'template_id' => $request->template_id,
            'clearance_type_id' => $request->clearance_type_id,
            'clearance_category_id' => $request->clearance_category_id,
            'barangay_id' => $request->barangay_id,
            'purpose' => $request->purpose,
            'created_by' => Auth::user()->id,

        ];
        $purposeData = ClearancePurpose::find($request->id);
        if(!empty($purposeData)){
            $purposeData->clearance_type_id = $request->clearance_type_id;
            $purposeData->clearance_category_id = $request->clearance_category_id;
            $purposeData->barangay_id = $request->barangay_id;
            $purposeData->purpose = $request->purpose;
            $purposeData->save();


            return customResponse()
            ->data(null)
            ->message("Clearance purpose updated.")
            ->success()
            ->generate();
         }else{
             return customResponse()
             ->data(null)
             ->message("Clearance purpose not found.")
             ->failed()
             ->generate();
         }

        return customResponse()
        ->data(null)
        ->message("Clearance purpose created.")
        ->success()
        ->generate();

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

        $purposeData = ClearancePurpose::find($request->id);
        if(!empty($purposeData)){
            $purposeData->delete();
            return customResponse()
            ->data(null)
            ->message("Clearance Purpose deleted.")
            ->success()
            ->generate();
        }else{
            return customResponse()
            ->data(null)
            ->message("Clearance Purpose not found")
            ->failed()
            ->generate();
        }

    }

    public function show(Request $request, $id){

        $purposeData = ClearancePurpose::find($id);
        if(!empty($purposeData)){
            return customResponse()
                ->data($purposeData)
                ->message("Clearance purpose data.")
                ->success()
                ->generate();
        }else{
            return customResponse()
                ->data(null)
                ->message("Clearance purpose not found.")
                ->failed()
                ->generate();
        }

    }

}
