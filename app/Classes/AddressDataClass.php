<?php

namespace App\Classes;

use Carbon\Carbon;

use App\Models\AddressData;

class AddressDataClass
{
    public function saveAddressData($request) {
        $userData = $request->user();

        $primaryFile = $request->file("primary_file");
        $secondaryFile = $request->file("secondary_file");

        $addressData = $userData->addressData;
        if (empty($addressData)) {
            $addressData = new AddressData;
            $addressData->user_id = $userData->id;
        }

        $addressData->blk = $request->blk;
        $addressData->street = $request->street;
        $addressData->barangay_id = $request->barangay_id;
        $addressData->district = $request->district;
        $addressData->zip_code = $request->zip_code;
        $addressData->full_address = $request->full_address;
        $addressData->address_type = $request->address_type;
        $addressData->temporary = $request->temporary;
        $addressData->starting_from = $request->starting_from;

        $addressData->primary_id_path = "";
        $addressData->primary_id_name = "";
        $addressData->secondary_id_path = "";
        $addressData->secondary_id_name = "";
        
        $addressData->save();
    }
}
