<?php

namespace App\Classes;

use Carbon\Carbon;

use App\Models\User;
use App\Models\HouseKeeper;

class HouseKeeperClass
{
    public function saveHouseKeeper($request) {
        $userData = $request->user();
        if (!empty($request->user_id)) {
            $userData = User::find($request->user_id);
        }

        HouseKeeper::where("user_id", $userData->user_id)->each(function($row){
            $row->delete();
        });

        foreach ($request->house_keeper_type_id as $key => $value) {
            $houseKeeperData = new HouseKeeper;
            $houseKeeperData->user_id = $request->user_id;
            $houseKeeperData->house_keeper_type_id = $request->house_keeper_type_id[$key];
            $houseKeeperData->first_name = $request->first_name[$key];
            $houseKeeperData->middle_name = $request->middle_name[$key];
            $houseKeeperData->last_name = $request->last_name[$key];
            $houseKeeperData->birth_date = $request->birth_date[$key];
            $houseKeeperData->contact_no = $request->contact_no[$key];
            $houseKeeperData->address = $request->address[$key];
            $houseKeeperData->same_address = $request->same_address[$key];
            $houseKeeperData->save();
        }
    }
}
