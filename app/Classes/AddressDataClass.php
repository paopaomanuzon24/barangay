<?php

namespace App\Classes;

use Carbon\Carbon;

use App\Models\AddressData;
use App\Models\User;

class AddressDataClass
{
    public function saveAddressData($request) {
        $userData = $request->user();
        if (!empty($request->user_id)) {
            $userData = User::find($request->user_id);
        }

        $addressData = $userData->addressData;
        if (empty($addressData)) {
            $addressData = new AddressData;
            $addressData->user_id = $userData->id;
        }

        $userData->address = $request->full_address;
        $userData->save();

        $addressData->blk = $request->blk;
        $addressData->street = $request->street;
        $addressData->barangay_id = $request->barangay_id;
        $addressData->district = $request->district;
        $addressData->zip_code = $request->zip_code;
        $addressData->full_address = $request->full_address;
        $addressData->address_type = $request->address_type;
        $addressData->temporary = $request->temporary;
        $addressData->starting_from = date("Y-m-d", strtotime($request->starting_from));

        if ($request->hasFile('primary_file')) {
            $primaryPath = 'images/address/primary';
            $primaryFile = $request->file("primary_file");
            $primaryFileName = $primaryFile->getClientOriginalName();

            $request->file('primary_file')->storeAs("public/".$primaryPath, $primaryFileName);

            $addressData->primary_id_path = $primaryPath.'/'.$primaryFileName;
            $addressData->primary_id_name = $primaryFileName;
        } else {
            $addressData->primary_id_path = !empty($addressData->primary_id_path) ? $addressData->primary_id_path : "";
            $addressData->primary_id_name = !empty($addressData->primary_id_name) ? $addressData->primary_id_name : "";
        }

        if ($request->hasFile("secondary_file")) {
            $secondaryPath = 'images/address/secondary';
            $secondaryFile = $request->file("secondary_file");
            $secondaryFileName = $secondaryFile->getClientOriginalName();

            $request->file('secondary_file')->storeAs("public/".$secondaryPath, $secondaryFileName);

            $addressData->secondary_id_path = $secondaryPath.'/'.$secondaryFileName;
            $addressData->secondary_id_name = $secondaryFileName;
        } else {
            $addressData->secondary_id_path = !empty($addressData->secondary_id_path) ? $addressData->secondary_id_path : "";
            $addressData->secondary_id_name = !empty($addressData->secondary_id_name) ? $addressData->secondary_id_name : "";
        }
        
        $addressData->save();
    }
}
