<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


use Illuminate\Support\Facades\Storage;

use App\Models\PermitTemplate;
use App\Models\PermitFees;
use App\Models\PermitType;
use App\Models\PermitHistory;
use App\Models\PermitStatus;
use App\Models\Barangay;
use App\Models\PermitSequence;
use Illuminate\Http\Response;
use App\Classes\Permit\PermitRequestClass;

class PermitRequestController extends Controller
{

    public function generatePermit(Request $request){

      #  $this->validateGeneratePermit($request);

     #   dd($request->input());
        $validator = Validator::make($request->all(),[
            #   'template_id' => 'required|integer|min:0',
               'barangay_id' => 'required|integer|min:1',
               'permit_type_id' => 'required|integer|min:1',
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



      /*   $templateData = PermitTemplate::find($request->template_id);

        if(empty($templateData)){
            return response()->json([
                'error' => 'invalid',
                'message' => "Template not found."
            ], 400);
        }

        $typeData = PermitType::find($request->permit_type_id);
        if(empty($typeData)){
            return response()->json([
                'error' => 'invalid',
                'message' => "Permit type not found."
            ], 400);
        }

        $feeData = PermitFees::find($request->permit_fee_id);
        if(empty($feeData)){
            return response()->json([
                'error' => 'invalid',
                'message' => "Permit Fee not found."
            ], 400);
        } */
        $controlNumber = "";
        $barangayId = $request->barangay_id;
        $barangayData = Barangay::find($barangayId);

        if(!empty($barangayData)){
            $sequenceData = PermitSequence::where("barangay_id",$barangayId)->first();
            if(!empty($sequenceData)){
                $sequence = $sequenceData->sequence + 1;
                $sequenceData->sequence = $sequenceData->sequence + 1;

            }else{
                $sequenceData = new PermitSequence;
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
        if(!empty($request['payment_image']) && !empty($request['reference_number'])){
            $status = PermitStatus::FOR_APPROVAL_STATUS;
        }else{
            $status = PermitStatus::FOR_PAYMENT_STATUS;
        }

        $path = "";
        $imageName = "";
        if($request->hasFile('payment_image') && !empty($request['reference_number'])){
            $path = 'public/images/permit/payment';
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
            'permit_type_id' => $request->permit_type_id,
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
        PermitHistory::create($data);




        return customResponse()
            ->data(null)
            ->message("Permit generated.")
            ->success()
            ->generate();
    }


    public function permitPayment(Request $request){


        $validator = Validator::make($request->all(),[
            'payment_file' => 'mimes:jpg,bmp,png,pdf,txt,doc,docx',
            'id' => 'required|integer|min:0',
        ]);

        if($validator->fails()){
            return customResponse()
            ->data(null)
            ->message($validator->errors()->all()[0])
            ->failed()
            ->generate();
        }

        $path = "";
        $imageName = "";

        if($request->hasFile('payment_file') && !empty($request['reference_number'])){

            $path = 'public/images/permit/payment';

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


            $status = PermitStatus::FOR_APPROVAL_STATUS;
            $historyData = PermitHistory::find($request['id']);
            $historyData->file_path = $path;
            $historyData->file_name = $imageName;
            $historyData->status_id = $status;
            $historyData->reference_number = $request['reference_number'];
            $historyData->save();
            return customResponse()
            ->data(null)
            ->message("Permit payment success.")
            ->success()
            ->generate();
        }

    }



    private function getSequenceNumber($barangayId){
        $return = "";
        $barangayData = Barangay::find($barangayId);

        if(!empty($barangayData)){
            $sequenceData = PermitSequence::where("barangay_id",$barangayId)->first();
            if(!empty($sequenceData)){
                $sequence = $sequenceData->sequence + 1;
                $sequenceData->sequence = $sequenceData->sequence + 1;

            }else{
                $sequenceData = new PermitSequence;
                $sequenceData->barangay_id = $barangayId;
                $sequenceData->sequence = 1;
                $sequence = 1;

            }
            $year = substr(date('Y'),2,2);
            $day = date('d');
            $sequence = str_pad($sequence, 5, '0', STR_PAD_LEFT);
            $return = $barangayId.''.$year.$day.$sequence;
            $sequenceData->save();
            return $return;
        }else{
            return customResponse()
            ->data(null)
            ->message("Barangay not found.")
            ->failed()
            ->generate();
        }


    }


    public function list(Request $request){

        $historyData = PermitHistory::where("user_id","!=","");

        if(!empty($request['barangay_id'])){
            $historyData = $historyData->where("barangay_id",$request['barangay_id']);
        }
        if(!empty($request['category_id'])){
            $historyData = $historyData->where("category_id",$request['category_id']);
        }
        if(!empty($request['permit_type_id'])){
            $historyData = $historyData->where("permit_type_id",$request['permit_type_id']);
        }
        if(!empty($request['user_id'])){
            $historyData = $historyData->where("user_id",$request['user_id']);
        }

        $historyData = $historyData->with('category','barangay','permitType','user','paymentMethod','status');
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
                'permit_type' => $row->permitType->permit_name,
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
            ->message("Permit request list.")
            ->success()
            ->generate();

    }

    public function show(Request $request, $id){

        $permitData = PermitHistory::find($id);
        if(!empty($permitData)){
            $userFullName = $permitData->user->first_name.' '. $permitData->user->middle_name.' '. $permitData->user->last_name;
            $payment_file = "";
            if(!empty($permitData->file_path)){
                $payment_file = $permitData->file_path.'/'.$permitData->file_name;
                $payment_file = Storage::url($payment_file);
            }

            $return = array(
                'id' => $permitData->id,
                'category' => $permitData->category->description,
                'barangay' => $permitData->barangay->description,
                'permit_type' => $permitData->permitType->permit_name,
                'user' => $userFullName,
                'payment_method' => $permitData->paymentMethod->description,
                'status' => $permitData->status->description,
                'release_date' => $permitData->release_date,
                'application_id' => $permitData->application_id,
                'reference_number' => $permitData->reference_number,
                'payment_file' => $payment_file,

            );
            return customResponse()
                ->data($return)
                ->message("Permit request data.")
                ->success()
                ->generate();
        }

    }

    public function denyRequest(Request $request){
        $status = PermitStatus::DENIED_STATUS;

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

        $permit = PermitHistory::find($request->id);
        if(!empty($permit)){
            if($permit->status_id == $status){
                 return customResponse()
                ->data(null)
                ->message("Permit is already denied.")
                ->failed()
                ->generate();
            }
            $permit->status_id = $status;
            $permit->feedback = $request->feedback;
            $permit->save();
            return customResponse()
            ->data(null)
            ->message("Permit denied.")
            ->success()
            ->generate();
        }else{
            return customResponse()
            ->data(null)
            ->message("Permit not found")
            ->failed()
            ->generate();
        }
    }

    public function getPermitPaymentData(Request $request,$id){
        $permitData = PermitHistory::find($id);
        if(!empty($permitData)){
            if(empty($permitData->file_name) && empty($permitData->file_path)){
                return customResponse()
                ->data(null)
                ->message("Payment proof not found.")
                ->failed()
                ->generate();
            }
            $path = $permitData->file_path.'/'.$permitData->file_name;

            $path = Storage::url($path);

            $return = array(
                'path'=> $path,
                'reference_number' => $permitData->reference_number
            );
            return customResponse()
            ->data($return)
            ->message("Permit proof data.")
            ->success()
            ->generate();
        }else{
            return customResponse()
            ->data(null)
            ->message("Permit not found")
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

        $permitData = PermitHistory::find($request->id);
        if(empty($permitData)){
            return customResponse()
            ->data(null)
            ->message("Permit request not found")
            ->failed()
            ->generate();
        }

        $status = PermitStatus::FOR_RELEAST_STATUS;
        $releaseDate = date('Y-m-d H:i:s');
        $permitData->release_date = $releaseDate;
        $permitData->status_id = $status;
        $permitData->save();

        return customResponse()
        ->data(null)
        ->message("Permit request approved.")
        ->success()
        ->generate();


    }

    public function editRequestLayout(Request $request,$id){


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
    }

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

    public function printPermit(Request $request){

        $permitClass = new PermitRequestClass;
        $permitClass->generatePermitLayout();
        # dd(public_path('Appdividend.docx'));
        $path = public_path('Appdividend.docx');
        #return Storage::download('helloWorld.docx');
        $headers = array(
            'Content-Type' => 'application/vnd.msword',

        );

       # $filename = 'img.png';
        $fsize = filesize($path);

        $handle = fopen($path, "rb");
        $contents = fread($handle, $fsize);
        fclose($handle);

        header('content-type: application/vnd.msword');
        header('Content-Length: ' . $fsize);

        return $contents;

        #return response()->download($path , "Appdividend.docx",$headers);



        /* return response()->make(view('report.accounting.list_of_studentbalance',$data), '200',
                [
                    'Content-Type'=>'application/pdf',
                    'Content-Disposition'=>'inline; filname="list_of_studentbalance.pdf"'
                ]); */
    #    return response()->file();

    #    $contents, 200, array('content-type'=>'application/pdf')




       # return response()->download(public_path('Appdividend.docx'));
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
