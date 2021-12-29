<?php

namespace App\Http\Controllers;

use Helpers;
use Session;
use Validator;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

use App\Classes\HouseHoldClass;

use App\Models\WaterSource;
use App\Models\LandOwnership;
use App\Models\Convenience;
use App\Models\BuildingHouseType;
use App\Models\Roof;

class HouseHoldController extends Controller
{
    public function index(Request $request, $id) {
        $userData = $this->userData($id);
        if (empty($userData)) {
            return customResponse()
                ->message("User not found.")
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
            ->message("Household data.")
            ->data($userData)
            ->success()
            ->generate();
    }

    public function store(Request $request) {
        $class = new HouseHoldClass;
        $store = $class->saveHouseHold($request);

        if (!empty($store['message'])) {
            return customResponse()
                ->data(null)
                ->message($store['message'])
                ->failed()
                ->generate();
        }

        return customResponse()
            ->message("Record has been saved.")
            ->data(null)
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
            ->message("List of water source.")
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
            ->message("List of land ownership.")
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
            ->message("List of presence of household conveniences / devices.")
            ->data($list)
            ->success()
            ->generate();
    }

    public function getRadioResidenceType(Request $request) {
        return customResponse()
            ->message("List of residence type.")
            ->data(Helpers::getRadioResidenceType())
            ->success()
            ->generate();
    }

    public function getInternetAccess(Request $request) {
        return customResponse()
            ->message("List of internet access.")
            ->data(Helpers::getInternetAccess())
            ->success()
            ->generate();
    }

    public function getBuildingHouseType(Request $request) {
        $list = BuildingHouseType::select(
            'id',
            'description'
        )
        ->get();

        return customResponse()
            ->message("List of building/house type.")
            ->data($list)
            ->success()
            ->generate();
    }

    public function getRoofList(Request $request) {
        $list = Roof::select(
            'id',
            'description'
        )
        ->get();

        return customResponse()
            ->message("List of construction materials of the roof.")
            ->data($list)
            ->success()
            ->generate();
    }
}
