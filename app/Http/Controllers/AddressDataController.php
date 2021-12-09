<?php

namespace App\Http\Controllers;

use Helpers;
use Session;
use Validator;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Classes\AddressDataClass;

class AddressDataController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'blk' => 'required|string',
            'street' => 'required|string',
            'barangay_id' => 'required',
            'district' => 'required|string',
            'zip_code' => 'required',
            'full_address' => 'required|string',
            'address_type' => 'required',
            'starting_from' => 'required',
            'primary_file' => 'mimes:jpg,bmp,png,jpeg|required',
            'secondary_file' => 'mimes:jpg,bmp,png,jpeg|required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()
            ], 400);
        }

        $class = new AddressDataClass;
        $class->saveAddressData($request);

        return response()->json([
            'message' => 'Record has been saved.'
        ], 201);        
    }

    public function getAddressData(Request $request) {
        $userData = $request->user();
        $addressData = $request->user()->addressData;
        return response()->json($userData);
    }

    public function getRadioAddressType(Request $request) {
        return response()->json(Helpers::getRadioAddressType());
    }

    public function getRadioTemporaryType(Request $request) {
        return response()->json(Helpers::getRadioTemporaryType());
    }
}
