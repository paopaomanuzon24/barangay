<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


use Illuminate\Support\Facades\Storage;

use App\Classes\Clearance\ClearanceRequestClass;
use App\Models\Barangay;
use App\Models\ClearanceCategory;
use App\Models\ClearanceHistory;
use App\Models\ClearanceSequence;
use App\Models\ClearanceStatus;
use App\Models\ClearanceType;
use App\Models\User;
use PDF;

class ClearanceRequestController extends Controller
{

    public function requestPermit(Request $request){


        $validator = Validator::make($request->all(),[
            'barangay_id' => 'required|integer|min:1',
            'clearance_type_id' => 'required|integer|min:1',
            'category_id' => 'required|integer|min:1',
            'user_id' => 'required|integer|min:1',
            'payment_method_id' => 'required|integer|min:1',
            'payment_image.*' => 'mimes:jpeg,jpg,png',
            'reference_number' => 'integer'
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

        $categoryData = ClearanceCategory::find($request->category_id);
        if(empty($categoryData)){
            return customResponse()
            ->data(null)
            ->message("Clearance category not found.")
            ->failed()
            ->generate();
        }

        $userData = User::find($request->user_id);
        if(empty($userData)){
            return customResponse()
            ->data(null)
            ->message("user not found.")
            ->failed()
            ->generate();
        }







        $controlNumber = "";
        $barangayId = $request->barangay_id;
        $barangayData = Barangay::find($barangayId);

        if(!empty($barangayData)){
            $sequenceData = ClearanceSequence::where("barangay_id",$barangayId)->first();
            if(!empty($sequenceData)){
                $sequence = $sequenceData->sequence + 1;
                $sequenceData->sequence = $sequenceData->sequence + 1;

            }else{
                $sequenceData = new ClearanceSequence;
                $sequenceData->barangay_id = $barangayId;
                $sequenceData->sequence = 1;
                $sequence = 1;

            }
            $year = substr(date('Y'),2,2);
            $day = date('d');
            $sequence = str_pad($sequence, 5, '0', STR_PAD_LEFT);
            $controlNumber = $barangayId.''.$year.$day.$sequence;
            $sequenceData->save();

        }else{
            return customResponse()
            ->data(null)
            ->message("Barangay not found.")
            ->failed()
            ->generate();
        }

       # $controlNumber = $this->getSequenceNumber($request->barangay_id);


        $status = ClearanceStatus::FOR_PAYMENT_STATUS;
        $path = "";
        $imageName = "";
        if($request->hasFile('payment_image') && !empty($request['reference_number'])){
            $status = ClearanceStatus::FOR_APPROVAL_STATUS;
            $path = 'public/images/clearance/payment';
            if(is_array($request->file('payment_image'))){
                $image = $request->file('payment_image')[0];
            }else{
                $image = $request->file('payment_image');
            }

            $imageName = $image->getClientOriginalName();

            if(is_array($request->file('payment_image'))){
                $request->file('payment_image')[0]->storeAs($path,$imageName);
            }else{
                $request->file('payment_image')->storeAs($path,$imageName);
            }


        }
        #$status = 1; //# for approval
        $data = [
           # 'template_id' => $request->template_id,
            'clearance_type_id' => $request->clearance_type_id,
            'category_id' => $request->category_id,
            'barangay_id' => $request->barangay_id,
            'application_id' => $controlNumber,

            'status_id' => $status,
            'user_id' => $request->user_id,
            'payment_method_id' => $request->payment_method_id,
            'file_name' => $imageName,
            'file_path' => $path,
            'reference_number' => $request['reference_number'],
            'is_waive' => !empty($request['is_waive']) ? 1:  0 ,
            'waive_reason' => $request['reason_for_waving']
        ];
        ClearanceHistory::create($data);




        return customResponse()
            ->data(null)
            ->message("Clearance request generated.")
            ->success()
            ->generate();
    }


    public function clearancePayment(Request $request){


        $validator = Validator::make($request->all(),[
            'payment_image.*' => 'mimes:jpeg,jpg,png',
            'id' => 'required|integer|min:1',
        ]);


        if($validator->fails()){
            return customResponse()
            ->data(null)
            ->message($validator->errors()->all()[0])
            ->failed()
            ->generate();
        }


        $historyData = ClearanceHistory::find($request['id']);
        if(empty($historyData)){
            return customResponse()
            ->data(null)
            ->message("Clearance not found")
            ->failed()
            ->generate();
        }
        $path = "";
        $imageName = "";
        #dd($request->input());

        if($request->hasFile('payment_image') && !empty($request['reference_number'])){

            $path = 'public/images/clearance/payment';

          #  $image = $request->file('payment_file');
          #  $imageName = $image->getClientOriginalName();

          #  $request->file('payment_file')->storeAs($path,$imageName);

            if(is_array($request->file('payment_image'))){
                $image = $request->file('payment_image')[0];
            }else{
                $image = $request->file('payment_image');
            }

            $imageName = $image->getClientOriginalName();

            if(is_array($request->file('payment_image'))){
                $request->file('payment_image')[0]->storeAs($path,$imageName);
            }else{
                $request->file('payment_image')->storeAs($path,$imageName);
            }


            $status = Clearancestatus::FOR_APPROVAL_STATUS;

            $historyData->file_path = $path;
            $historyData->file_name = $imageName;
            $historyData->status_id = $status;
            $historyData->reference_number = $request['reference_number'];
            $historyData->save();
            return customResponse()
            ->data(null)
            ->message("Clearance payment success.")
            ->success()
            ->generate();
        }

    }





    public function list(Request $request){

        $historyData = ClearanceHistory::where("user_id","!=","");

        if(!empty($request['barangay_id'])){
            $historyData = $historyData->where("barangay_id",$request['barangay_id']);
        }
        if(!empty($request['category_id'])){
            $historyData = $historyData->where("category_id",$request['category_id']);
        }
        if(!empty($request['clearance_type_id'])){
            $historyData = $historyData->where("clearance_type_id",$request['clearance_type_id']);
        }
        if(!empty($request['user_id'])){
            $historyData = $historyData->where("user_id",$request['user_id']);
        }

        $historyData = $historyData->with('category','barangay','clearanceType','user','paymentMethod','status');
        if(!empty($request['sort'])){
            switch($request['sort']){

                case "desc":
                    $historyData = $historyData->orderByDesc("id");
                break;
            }
        }
        $historyData = $historyData->get();

        $return = array();
        foreach($historyData as $row){

            $userFullName = $row->user->first_name.' '. $row->user->middle_name.' '. $row->user->last_name;
            $return[] = array(
                'id' => $row->id,
                'category' => $row->category->description,
                'barangay' => $row->barangay->description,
                'clearance_type' => $row->clearanceType->clearance_name,
                'user' => $userFullName,
                'payment_method' => $row->paymentMethod->description,
                'status' => $row->status->description,
                'release_date' => $row->release_date,
                'application_id' => $row->application_id,
                'request_date' => $row->created_at

            );

        }

        return customResponse()
            ->data($return)
            ->message("Clearance request list.")
            ->success()
            ->generate();

    }

    public function show(Request $request, $id){

        $clearanceData = ClearanceHistory::find($id);
        if(!empty($clearanceData)){
            $userFullName = $clearanceData->user->first_name.' '. $clearanceData->user->middle_name.' '. $clearanceData->user->last_name;
            $payment_file = "";
            if(!empty($clearanceData->file_path)){
                $payment_file = $clearanceData->file_path.'/'.$clearanceData->file_name;
                $payment_file = Storage::url($payment_file);
            }

            $return = array(
                'id' => $clearanceData->id,
                'category' => $clearanceData->category->description,
                'barangay' => $clearanceData->barangay->description,
                'clearance_type' => $clearanceData->clearanceType->clearance_name,
                'user' => $userFullName,
                'payment_method' => $clearanceData->paymentMethod->description,
                'status' => $clearanceData->status->description,
                'release_date' => $clearanceData->release_date,
                'application_id' => $clearanceData->application_id,
                'reference_number' => $clearanceData->reference_number,
                'payment_file' => $payment_file,

            );
            return customResponse()
                ->data($return)
                ->message("Clearance request data.")
                ->success()
                ->generate();
        }else{
            return customResponse()
                ->data(null)
                ->message("Clearance not found.")
                ->success()
                ->generate();
        }

    }

    public function denyRequest(Request $request){
        $status = ClearanceStatus::DENIED_STATUS;

        $validator = Validator::make($request->all(),[
            'feedback' => 'string',
            'id' => 'required|integer|min:1',
        ]);

        if($validator->fails()){
            return customResponse()
            ->data(null)
            ->message($validator->errors()->all()[0])
            ->failed()
            ->generate();
        }

        $clearance = ClearanceHistory::find($request->id);
        if(!empty($clearance)){
            if($clearance->status_id == $status){
                 return customResponse()
                ->data(null)
                ->message("Clearance is already denied.")
                ->failed()
                ->generate();
            }
            $clearance->status_id = $status;
            $clearance->feedback = $request->feedback;
            $clearance->save();
            return customResponse()
            ->data(null)
            ->message("Clearance denied.")
            ->success()
            ->generate();
        }else{
            return customResponse()
            ->data(null)
            ->message("Clearance not found")
            ->failed()
            ->generate();
        }
    }

    public function getClearancePaymentData(Request $request,$id){
        $clearanceData = ClearanceHistory::find($id);
        if(!empty($clearanceData)){
            if(empty($clearanceData->file_name) && empty($clearanceData->file_path)){
                return customResponse()
                ->data(null)
                ->message("Payment proof not found.")
                ->failed()
                ->generate();
            }
            $path = $clearanceData->file_path.'/'.$clearanceData->file_name;

            $path = Storage::url($path);

            $return = array(
                'path'=> $path,
                'reference_number' => $clearanceData->reference_number
            );
            return customResponse()
            ->data($return)
            ->message("Clearance proof data.")
            ->success()
            ->generate();
        }else{
            return customResponse()
            ->data(null)
            ->message("Clearance not found")
            ->failed()
            ->generate();
        }
    }

    public function approveRequest(Request $request){
        $validator = Validator::make($request->all(),[
            'id' => 'required|integer|min:1',
        ]);
        if($validator->fails()){
            return customResponse()
            ->data(null)
            ->message($validator->errors()->all()[0])
            ->failed()
            ->generate();
        }

        $clearanceData = ClearanceHistory::find($request->id);
        if(empty($clearanceData)){
            return customResponse()
            ->data(null)
            ->message("Clearance request not found")
            ->failed()
            ->generate();
        }

        $status = ClearanceStatus::FOR_RELEAST_STATUS;
        $releaseDate = date('Y-m-d H:i:s');
        $clearanceData->release_date = $releaseDate;
        $clearanceData->status_id = $status;
        $clearanceData->save();

        return customResponse()
        ->data(null)
        ->message("Clearance request approved.")
        ->success()
        ->generate();


    }

   /*  public function editRequestLayout(Request $request,$id){


        $permitData = PermitHistory::find($id);
        if(empty($permitData)){
            return customResponse()
            ->data(null)
            ->message("Permit request not found")
            ->failed()
            ->generate();
        }

        $userFullName = $permitData->user->first_name.' '. $permitData->user->middle_name.' '. $permitData->user->last_name;
        $return = array(
            'id' => $permitData->id,
            'user' => $userFullName,
            'position' => "",
            "address" => "",
            "hotline" => "",
            "email" => ""
        );
        return customResponse()
            ->data($return)
            ->message("Permit layout data.")
            ->success()
            ->generate();
    } */
/*
    public function updateRequestLayout(Request $request){
        $validator = Validator::make($request->all(),[
            'id' => 'required|integer|min:1',
        ]);
        if($validator->fails()){
            return customResponse()
            ->data(null)
            ->message($validator->errors()->all()[0])
            ->failed()
            ->generate();
        }

        $permitData = PermitHistory::find($request->id);
        if(empty($permitData)){
            return customResponse()
            ->data(null)
            ->message("Permit request not found")
            ->failed()
            ->generate();
        }
    }
 */
    public function printClearance(Request $request){

        $permitClass = new ClearanceRequestClass;
        $permitClass->generateLayout();

        $path = public_path('Clearance.docx');

        $headers = array(
            'Content-Type' => 'application/vnd.msword',

        );


        $fsize = filesize($path);

        $handle = fopen($path, "rb");
        $contents = fread($handle, $fsize);
        fclose($handle);

        header('content-type: application/vnd.msword');
        header('Content-Length: ' . $fsize);

        return $contents;


    }

    public function printClearancePDF(Request $request){

        $validator = Validator::make($request->all(),[
            'user_id' => 'required|integer|min:1',
        ]);
        if($validator->fails()){
            return customResponse()
            ->data(null)
            ->message($validator->errors()->all()[0])
            ->failed()
            ->generate();
        }

        $userData = User::find($request->user_id);
        if(empty($userData)){
            return customResponse()
            ->data(null)
            ->message("User not found.")
            ->failed()
            ->generate();
        }

        $name = $userData->first_name.' '.$userData->middle_name.' '.$userData->last_name;
        $address = $userData->address;
        $data = array(
            'title' => "pao",
            "date" => "date",
            "name" => $name,
            "address" => $address,
            "day" => date('d'),
            "month" => date('F Y'),
        );




        #dd(public_path("images\Cedula.jpg"));
        #dd(URL::to(''));
        $pdf = PDF::loadView('report.clearance.clearance1', $data);
       # $pdf->output(['isRemoteEnabled' => true]);
        return $pdf->download('clearance.pdf');
        return $pdf->download('clearance.pdf')->getOriginalContent();

    }

    /* public function edit(Request $request,$id){


        $permitData = PermitHistory::find($id);


        if(!empty($permitData)){
            $userFullName = $permitData->user->first_name.' '. $permitData->user->middle_name.' '. $permitData->user->last_name;
            $return = array(
                'id' => $permitData->id,
                'category' => $permitData->category->description,
                'barangay' => $permitData->barangay->description,
                'permit_type' => $permitData->permitType->permit_name,
                'user' => $userFullName,
                'payment_method' => $permitData->paymentMethod->description,
                'status' => $permitData->status->description,
                'release_date' => $permitData->release_date,
                'application_id' => $permitData->application_id

            );
            return customResponse()
                ->data($return)
                ->message("Permit request data.")
                ->success()
                ->generate();
        }else{
            return customResponse()
            ->data(null)
            ->message("Permit not found")
            ->failed()
            ->generate();
        }

    } */
}
