<?php

namespace App\Http\Controllers;

use QrCode;
use PDF;
use Helpers;
use Session;
use Validator;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\User as UserModel;
use App\Models\BarangayIDGenerated;

class BarangayController extends Controller
{
    public function printBarangayID(Request $request){
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
        ]);
        if($validator->fails()){
            return customResponse()
            ->data(null)
            ->message($validator->errors()->all()[0])
            ->failed()
            ->generate();
        }

        $userData = UserModel::find($request->user_id);
        if(empty($userData)){
            return customResponse()
            ->data(null)
            ->message("User not found.")
            ->failed()
            ->generate();
        }

        // $hasID = BarangayIDGenerated::where("user_id", $request->user_id)
        //     ->whereDate("date_expiration", ">", date('Y-m-d'))
        //     ->first();
        // if(!empty($hasID)){
        //     return customResponse()
        //     ->data(null)
        //     ->message("Already generated id.")
        //     ->failed()
        //     ->generate();
        // }

        $residentID = $userData->personalData->resident_id;
        $barangay = $userData->barangayData->description;

        $name = ucfirst($userData->first_name) .' '. ucfirst($userData->last_name);
        if (!empty($userData->middle_name)) {
            $name = ucfirst($userData->first_name).' '.strtoupper($userData->middle_name[0]).' '.ucfirst($userData->last_name);
        }
        $address = $userData->address;
        $contact = $userData->contact_no;
        $birthDate = $userData->birth_date;

        $title = "BARANGAY " . $barangay;
        $detailFormat = "BRGY ID: " . $residentID . "\n\n" . "Name: " . $name . "\n\n" . "Address: " . $address . "\n\n" . "Contact No.: " . $contact;
        $generateQRCode = QrCode::size(300)->generate($detailFormat);
        $qrCode = base64_encode($generateQRCode);

        $data = array(
            'user_id' => $request->user_id,
            'title' => $title,
            "dateCreated" => date('Y-m-d'),
            "dateExpiration" => date('Y-m-d', strtotime(date('Y-m-d'). ' + 1 year')),
            "name" => $name,
            "address" => $address,
            "contact" => $contact,
            "residentID" => $residentID,
            "birthDate" => date("F d, Y", strtotime($birthDate)),
            "qrCode" => $qrCode
        );

        BarangayIDGenerated::insert([
            'user_id' => $data['user_id'],
            'date_created' => $data['dateCreated'],
            'date_expiration' => $data['dateExpiration'],
            'qrCode' => $data['qrCode']
        ]);

        $pdf = PDF::loadView('report.barangay.generate_id', $data)->setPaper('a4','landscape');
        // $pdf = PDF::loadView('report.barangay.generate_id', $data)->setPaper('catalog #10 1/2 envelope','landscape');
        // return $pdf->download($residentID . '.pdf');
        return $pdf->download($residentID . '.pdf')->getOriginalContent();
    }
}
