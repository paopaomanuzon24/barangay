<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\MedicineInventory;


class MedicineInventoryController extends Controller
{

    public function store(Request $request){


        $validator = Validator::make($request->all(),[
            'description' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'status_id' => 'required|integer|min:1'

        ]);

        if($validator->fails()){
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $barangayId = Auth::user()->barangay_id;




        $medicine = new MedicineInventory;
        $medicine->description = $request->description;
        $medicine->barangay_id = $barangayId;
        $medicine->expiration_date = $request->expiration_date;
        $medicine->status_id = $request->status_id;
        $medicine->quantity = $request->quantity;
        $medicine->save();


        return customResponse()
            ->data(null)
            ->message("Medicine Added.")
            ->success()
            ->generate();



    }

    public function show(Request $request, $id){

        $medicineData = MedicineInventory::find($id);
        if(!empty($medicineData)){
            $return = $medicineData->getOriginal();

            $return = array(
                'id' => $medicineData->id,
                'description' => $medicineData->description,
                'quantity' => $medicineData->quantity,
                'expiration_date' => $medicineData->expiration_date,
                'status' => $medicineData->status->description,
            );
            return customResponse()
                ->data($return)
                ->message("Medicine Data.")
                ->success()
                ->generate();
        }

    }

    public function edit(Request $request, $id){



        $medicineData = MedicineInventory::find($id);
        if(!empty($medicineData)){
            return customResponse()
                ->data($medicineData)
                ->message("Medicine Data.")
                ->success()
                ->generate();
        }else{
            return customResponse()
                ->data(null)
                ->message("Medicine not found.")
                ->failed()
                ->generate();
        }

    }

    public function update(Request $request){

        $validator = Validator::make($request->all(),[
            'description' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'status_id' => 'required|integer|min:1'

        ]);

        if($validator->fails()){
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }



        $medicine = MedicineInventory::find($request->id);
        if(!empty($medicine)){

            $medicine->description = $request->description;
        #    $medicine->barangay_id = $barangayId;
            $medicine->expiration_date = $request->expiration_date;
            $medicine->status_id = $request->status_id;
            $medicine->quantity = $request->quantity;
            $medicine->save();

            return customResponse()
            ->data(null)
            ->message("Medicine Updated.")
            ->success()
            ->generate();
        }else{
            return customResponse()
            ->data(null)
            ->message("Medicine not found.")
            ->failed()
            ->generate();
        }




    }

    public function delete(Request $request){



        $medicine = MedicineInventory::find($request->id);
        if(!empty($medicine)){
            $medicine->delete();
            return customResponse()
            ->data(null)
            ->message("Medicine deleted.")
            ->success()
            ->generate();
        }else{
            return customResponse()
            ->data(null)
            ->message("Medicine not found.")
            ->failed()
            ->generate();
        }
    }



    public function list(Request $request){


        $medicine = MedicineInventory::where("description","!=","");
        if(!empty($request['barangay_id'])){
            $medicine = $medicine->where("barangay_id",$request->barangay_id);
        }


        $medicine = $medicine->get();
        $return = array();
        foreach($medicine as $row){
            $return[] = array(
                'id' => $row->id,
                'description' => $row->description,
                'quantity' => $row->quantity,
                'expiration_date' => $row->expiration_date,
                'status' => $row->status->description,
            );
        }
        if(empty($medicine)){
            return customResponse()
            ->data(null)
            ->message("No medicine found")
            ->success()
            ->generate();
        }


        return customResponse()
            ->data($medicine)
            ->message("Medicine list.")
            ->success()
            ->generate();

        #return response()->json($return);
    }
}
