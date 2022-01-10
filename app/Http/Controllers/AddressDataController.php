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

use App\Models\User as UserModel;

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
            'primary_file' => 'mimes:jpg,bmp,png,jpeg',
            'secondary_file' => 'mimes:jpg,bmp,png,jpeg'
        ]);

        if ($validator->fails()) {
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $class = new AddressDataClass;
        $class->saveAddressData($request);

        return customResponse()
            ->data(null)
            ->message('Record has been saved.')
            ->success()
            ->generate();        
    }

    public function getAddressData(Request $request, $id) {
        $userData = UserModel::find($id);
        if (empty($userData)) {
            return customResponse()
                ->message("No data")
                ->data(null)
                ->failed()
                ->generate();
        }
        
        $addressData = $userData->addressData;

        return customResponse()
            ->message("Address data.")
            ->data($userData)
            ->success()
            ->generate();
    }

    public function getRadioAddressType(Request $request) {
        return customResponse()
            ->message("Radio address type.")
            ->data(Helpers::getRadioAddressType())
            ->success()
            ->generate();
    }

    public function getRadioTemporaryType(Request $request) {
        return customResponse()
            ->message("Radio temporary type.")
            ->data(Helpers::getRadioTemporaryType())
            ->success()
            ->generate();
    }
}
