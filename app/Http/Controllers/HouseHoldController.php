<?php

namespace App\Http\Controllers;

use Helpers;
use Session;
use Validator;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Classes\HouseHoldClass;

use App\Models\WaterSource;
use App\Models\LandOwnership;
use App\Models\Convenience;
use App\Models\User as UserModel;

class HouseHoldController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'septic_tank' => 'required',
            'house_photo' => 'mimes:jpg,bmp,png,jpeg|required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()
            ], 400);
        }

        $class = new HouseHoldClass;
        $class->saveHouseHold($request);

        return response()->json([
            'message' => 'Record has been saved.'
        ], 201); 
        // return customResponse()
        //         ->message("Record has been saved.")
        //         ->data(null)
        //         ->success()
        //         ->generate();    
    }

    public function getHouseHold(Request $request, $id) {
        $userData = UserModel::find($id);
        if (empty($userData)) {
            return customResponse()
                ->message("No data")
                ->data(null)
                ->failed()
                ->generate();
        }
        
        $houseHoldData = $userData->houseHold;
        $waterSourceList = !empty($houseHoldData->waterSource) ? $houseHoldData->waterSource : "";
        $landOwnershipList = !empty($houseHoldData->landOwnership) ? $houseHoldData->landOwnership : "";
        $presenceHouseHoldList = !empty($houseHoldData->presenceHouseHold) ? $houseHoldData->presenceHouseHold : "";
        $internetAccessList = !empty($houseHoldData->internetAccess) ? $houseHoldData->internetAccess : "";

        return customResponse()
            ->message("Household")
            ->data($userData)
            ->success()
            ->generate();
    }

    public function getWaterSourceList(Request $request) {
        $list = WaterSource::select(
            'id',
            'description'
        )
        ->get();

        return customResponse()
            ->message("List of water source")
            ->data($list)
            ->success()
            ->generate();
    }

    public function getLandOwnershipList(Request $request) {
        $list = LandOwnership::select(
            'id',
            'description'
        )
        ->get();

        return customResponse()
            ->message("List of land ownership")
            ->data($list)
            ->success()
            ->generate();
    }

    public function getPresenceList(Request $request) {
        $list = Convenience::select(
            'id',
            'description'
        )
        ->get();

        return customResponse()
            ->message("List of presence of household conveniences / devices")
            ->data($list)
            ->success()
            ->generate();
    }

    public function getRadioResidenceType(Request $request) {
        return customResponse()
            ->message("List of residence type")
            ->data(Helpers::getRadioResidenceType())
            ->success()
            ->generate();
    }

    public function getInternetAccess(Request $request) {
        return customResponse()
            ->message("List of internet access")
            ->data(Helpers::getInternetAccess())
            ->success()
            ->generate();
    }
}
