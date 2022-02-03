<?php

namespace App\Http\Controllers;

use Helpers;
use Session;
use Validator;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\BlotterType;
use App\Models\BlotterStatus;
use App\Models\BlotterAndComplain;
use App\Models\User as UserModel;

class BlotterAndComplainController extends Controller
{
    public function blotterList(Request $request) {
        $blotterList = BlotterAndComplain::select(
            'blotter_and_complain_data.id as blotter_id',
            'blotter_and_complain_data.blotter_no',
            // 'blotter_and_complain_data.user_id',
            'blotter_and_complain_data.barangay_id',
            'barangays.description as barangay_desc',
            // 'users.first_name',
            // 'users.last_name',
            // 'users.address',
            // 'users.contact_no',
            // 'blotter_and_complain_data.blotter_type_id',
            // 'blotter_type.description as blotter_type_desc',
            'blotter_and_complain_data.blotter_complainant',
            'blotter_and_complain_data.blotter_complainee',
            'blotter_and_complain_data.blotter_address',
            'blotter_and_complain_data.blotter_subject',
            'blotter_and_complain_data.blotter_complaint_content',
            'blotter_and_complain_data.created_at as blotter_date_reported',
            'blotter_and_complain_data.blotter_status_id',
            'blotter_status.description as blotter_status_desc',
            'blotter_and_complain_data.blotter_agreement_content',
            'blotter_and_complain_data.blotter_payment_method_id',
            'permit_payment_method.description as blotter_payment_method_desc',
            'blotter_and_complain_data.blotter_receipt_file_path',
            'blotter_and_complain_data.blotter_receipt_file_name',
            'blotter_and_complain_data.blotter_waive_reason',
            'blotter_and_complain_data.blotter_date_resolved'
        )
        // ->leftJoin('users', 'users.id', 'blotter_and_complain_data.user_id')
        ->leftJoin('barangays', 'barangays.id', 'blotter_and_complain_data.barangay_id')
        ->leftJoin('blotter_status', 'blotter_status.id', 'blotter_and_complain_data.blotter_status_id')
        ->leftJoin('blotter_type', 'blotter_type.id', 'blotter_and_complain_data.blotter_type_id')
        ->leftJoin('permit_payment_method', 'permit_payment_method.id', 'blotter_and_complain_data.blotter_payment_method_id');

        if ($request->search) {
            $blotterList = $blotterList->where(function($q) use($request){
                // $q->orWhereRaw("CONCAT_WS(' ',CONCAT(last_name,','),first_name,first_name) LIKE ?","%".$request->search."%");
                $q->orWhereRaw("blotter_and_complain_data.blotter_no LIKE ?","%".$request->search."%");
                $q->orWhereRaw("blotter_and_complain_data.blotter_complainant LIKE ?","%".$request->search."%");
                $q->orWhereRaw("blotter_and_complain_data.blotter_complainee LIKE ?","%".$request->search."%");
            });
        }

        if ($request->barangay_id) {
            $blotterList = $blotterList->where("blotter_and_complain_data.barangay_id", $request->barangay_id);
        }

        if ($request->blotter_type_id) {
            $blotterList = $blotterList->where("blotter_and_complain_data.blotter_type_id", $request->blotter_type_id);
        }

        $blotterList = $blotterList->paginate(
            (int) $request->get('per_page', 10),
            ['*'],
            'page',
            (int) $request->get('page', 1)
        );

        return customResponse()
            ->message("Blotter list.")
            ->data($blotterList)
            ->success()
            ->generate();
    }

    public function list(Request $request, $id) {
        $blotterList = BlotterAndComplain::select(
            'blotter_and_complain_data.id as blotter_id',
            'blotter_and_complain_data.blotter_no',
            'blotter_and_complain_data.user_id',
            'blotter_and_complain_data.barangay_id',
            'barangays.description as barangay_desc',
            'users.first_name',
            'users.last_name',
            'users.address',
            'users.contact_no',
            'blotter_and_complain_data.blotter_type_id',
            'blotter_type.description as blotter_type_desc',
            'blotter_and_complain_data.blotter_complainant',
            'blotter_and_complain_data.blotter_complainee',
            'blotter_and_complain_data.blotter_address',
            'blotter_and_complain_data.blotter_subject',
            'blotter_and_complain_data.blotter_complaint_content',
            'blotter_and_complain_data.created_at as blotter_date_reported',
            'blotter_and_complain_data.blotter_status_id',
            'blotter_status.description as blotter_status_desc',
            'blotter_and_complain_data.blotter_agreement_content',
            'blotter_and_complain_data.blotter_payment_method_id',
            'permit_payment_method.description as blotter_payment_method_desc',
            'blotter_and_complain_data.blotter_receipt_file_path',
            'blotter_and_complain_data.blotter_receipt_file_name',
            'blotter_and_complain_data.blotter_waive_reason',
            'blotter_and_complain_data.blotter_date_resolved'
        )
        ->leftJoin('users', 'users.id', 'blotter_and_complain_data.user_id')
        ->leftJoin('barangays', 'barangays.id', 'blotter_and_complain_data.barangay_id')
        ->leftJoin('blotter_status', 'blotter_status.id', 'blotter_and_complain_data.blotter_status_id')
        ->leftJoin('blotter_type', 'blotter_type.id', 'blotter_and_complain_data.blotter_type_id')
        ->leftJoin('permit_payment_method', 'permit_payment_method.id', 'blotter_and_complain_data.blotter_payment_method_id')
        ->where('blotter_and_complain_data.user_id', $id);

        if ($request->search) {
            $blotterList = $blotterList->where(function($q) use($request){
                $q->orWhereRaw("blotter_and_complain_data.blotter_no LIKE ?","%".$request->search."%");
                $q->orWhereRaw("blotter_and_complain_data.blotter_complainant LIKE ?","%".$request->search."%");
                $q->orWhereRaw("blotter_and_complain_data.blotter_complainee LIKE ?","%".$request->search."%");
            });
        }

        if ($request->barangay_id) {
            $blotterList = $blotterList->where("blotter_and_complain_data.barangay_id", $request->barangay_id);
        }

        if ($request->blotter_type_id) {
            $blotterList = $blotterList->where("blotter_and_complain_data.blotter_type_id", $request->blotter_type_id);
        }

        $blotterList = $blotterList->paginate(
            (int) $request->get('per_page', 10),
            ['*'],
            'page',
            (int) $request->get('page', 1)
        );

        return customResponse()
            ->message("Blotter list.")
            ->data($blotterList)
            ->success()
            ->generate();
    }

    public function show(Request $request, $id) {
        $blotterData = BlotterAndComplain::select(
            'blotter_and_complain_data.id as blotter_id',
            'blotter_and_complain_data.blotter_no',
            // 'blotter_and_complain_data.user_id',
            'blotter_and_complain_data.barangay_id',
            'barangays.description as barangay_desc',
            // 'users.first_name',
            // 'users.last_name',
            // 'users.address',
            // 'users.contact_no',
            // 'blotter_and_complain_data.blotter_type_id',
            // 'blotter_type.description as blotter_type_desc',
            'blotter_and_complain_data.blotter_complainant',
            'blotter_and_complain_data.blotter_complainee',
            'blotter_and_complain_data.blotter_address',
            'blotter_and_complain_data.blotter_subject',
            'blotter_and_complain_data.blotter_complaint_content',
            'blotter_and_complain_data.created_at as blotter_date_reported',
            'blotter_and_complain_data.blotter_status_id',
            'blotter_status.description as blotter_status_desc',
            'blotter_and_complain_data.blotter_agreement_content',
            'blotter_and_complain_data.blotter_payment_method_id',
            'permit_payment_method.description as blotter_payment_method_desc',
            'blotter_and_complain_data.blotter_receipt_file_path',
            'blotter_and_complain_data.blotter_receipt_file_name',
            'blotter_and_complain_data.blotter_waive_reason',
            'blotter_and_complain_data.blotter_date_resolved'
        )
        // ->leftJoin('users', 'users.id', 'blotter_and_complain_data.user_id')
        ->leftJoin('barangays', 'barangays.id', 'blotter_and_complain_data.barangay_id')
        ->leftJoin('blotter_status', 'blotter_status.id', 'blotter_and_complain_data.blotter_status_id')
        ->leftJoin('blotter_type', 'blotter_type.id', 'blotter_and_complain_data.blotter_type_id')
        ->leftJoin('permit_payment_method', 'permit_payment_method.id', 'blotter_and_complain_data.blotter_payment_method_id')
        ->find($id);

        if (empty($blotterData)) {
            return customResponse()
                ->message("No data.")
                ->data(null)
                ->failed()
                ->generate();
        }

        return customResponse()
            ->message("Blotter data.")
            ->data($blotterData)
            ->success()
            ->generate();
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'barangay_id' => 'required',
            // 'blotter_type_id' => 'required',
            'blotter_complaint_content' => 'required'
        ]);

        if($validator->fails()){
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $userData = $request->user();
        if (!empty($request->user_id)) {
            $userData = UserModel::find($request->user_id);
        }

        $blotterData = BlotterAndComplain::find($request->blotter_id);
        if (empty($blotterData)) {
            $blotterData = new BlotterAndComplain;
        }

        $blotterData->barangay_id = $request->barangay_id;
        // $blotterData->user_id = $userData->id;
        $blotterData->blotter_complainant = $request->blotter_complainant;
        $blotterData->blotter_complainee = $request->blotter_complainee;
        $blotterData->blotter_address = $request->blotter_address;
        $blotterData->blotter_subject = $request->blotter_subject;
        // $blotterData->blotter_type_id = $request->blotter_type_id;
        $blotterData->blotter_complaint_content = $request->blotter_complaint_content;
        // $blotterData->blotter_status_id = !empty($request->blotter_status_id) ? $request->blotter_status_id : 2;
        $blotterData->blotter_status_id = 2;
        // $blotterData->blotter_date_resolved = !empty($request->blotter_date_resolved) ? date("Y-m-d", strtotime($request->blotter_date_resolved)) : null;
        // $blotterData->blotter_amount = !empty($request->blotter_amount) ? $request->blotter_amount : 0.00;
        $blotterData->save();

        if (empty($request->blotter_id)) {
            $defSeq = "00000000";
            $sequence = substr($defSeq, strlen($blotterData->id)) . $blotterData->id;
            $blotterNo = "#BLTTR" . date("Y") . $sequence;

            $blotterData->blotter_no = $blotterNo;
            $blotterData->save();
        }

        return customResponse()
            ->data(null)
            ->message('Record has been saved.')
            ->success()
            ->generate(); 
    }

    public function resolution(Request $request) {
        $validator = Validator::make($request->all(),[
            'blotter_agreement_content' => 'required'
        ]);

        if($validator->fails()){
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $blotterData = BlotterAndComplain::find($request->blotter_id);
        if (empty($blotterData)) {
            return customResponse()
                ->data(null)
                ->message("No data.")
                ->failed()
                ->generate();
        }

        $blotterData->blotter_status_id = 1;
        $blotterData->blotter_agreement_content = $request->blotter_agreement_content;
        $blotterData->blotter_payment_method_id = $request->blotter_payment_method_id;
        $blotterData->blotter_date_resolved = date("Y-m-d H:i:s");
        
        if ($request->hasFile('blotter_receipt_file')) {
            $file = $request->file("blotter_receipt_file");

            $path = 'images/receipt/blotter';

            $image = $file;
            $imageName = $image->getClientOriginalName();

            $file->storeAs("public/".$path, $imageName);
            
            $blotterData->blotter_receipt_file_path = $path.'/'.$imageName;
            $blotterData->blotter_receipt_file_name = $imageName;
            $blotterData->save();
        }

        $blotterData->blotter_waive_reason = $request->blotter_waive_reason;
        $blotterData->save();

        return customResponse()
            ->data(null)
            ->message('Record has been saved.')
            ->success()
            ->generate();
    }

    public function destroy(Request $request, $id) {
        $data = BlotterAndComplain::find($id);
        if (empty($data)) {
            return customResponse()
                ->message("No data.")
                ->data(null)
                ->failed()
                ->generate();
        }

        $data->delete();

        return customResponse()
            ->message("Record has been saved.")
            ->data(null)
            ->success()
            ->generate();
    }

    public function getBlotterTypeList(Request $request) {
        $list = BlotterType::select(
            'id',
            'description'
        )
        ->get();

        return customResponse()
            ->message("List of blotter type.")
            ->data($list)
            ->success()
            ->generate();
    }

    public function getBlotterStatusList(Request $request) {
        $list = BlotterStatus::select(
            'id',
            'description'
        )
        ->get();

        return customResponse()
            ->message("List of blotter status.")
            ->data($list)
            ->success()
            ->generate();
    }
}
