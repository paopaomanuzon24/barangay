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

use App\Models\HouseHoldSourceWater;
use App\Models\WaterSource;
use App\Models\LandOwnership;
use App\Models\Convenience;
use App\Models\BuildingHouseType;
use App\Models\Roof;
use App\Models\Wall;
use App\Models\BuildingHouseRepair;
use App\Models\YearBuilt;
use App\Models\FloorArea;
use App\Models\Lighting;
use App\Models\Cooking;
use App\Models\HouseStatus;
use App\Models\HouseAcquisition;
use App\Models\HouseFinancingSource;
use App\Models\MonthlyRental;
use App\Models\LotStatus;
use App\Models\GarbageDisposal;
use App\Models\ToiletFacility;
use App\Models\User;

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

    public function houseHoldWaterSourceList(Request $request) {
        $userData = $request->user();
        if (!empty($request->user_id)) {
            $userData = User::find($request->user_id);
        }

        $houseHoldWaterSourceList = HouseHoldSourceWater::select(
            'house_hold_source_water.id',
            'house_hold_source_water.user_id',
            'house_hold_source_water.source_water_id',
            'source_water.description as source_water_desc',
            'house_hold_source_water.drinking',
            'house_hold_source_water.cooking',
            'house_hold_source_water.laundry'
        )
        ->join("source_water", "source_water.id", "house_hold_source_water.source_water_id")
        ->get();

        return customResponse()
            ->message("House Hold Source Of Water.")
            ->data($houseHoldWaterSourceList)
            ->success()
            ->generate(); 
    }

    public function saveHouseHoldWaterSource(Request $request) {
        $userData = $request->user();
        if (!empty($request->user_id)) {
            $userData = User::find($request->user_id);
        }

        if (empty($request->drinking) && empty($request->cooking) && empty($request->laundry)) {
            $waterSourceData = HouseHoldSourceWater::where("user_id", $userData->id)
                ->where("source_water_id", $request->source_water_id)
                ->first();
            if (!empty($waterSourceData)) {
                $waterSourceData->delete();
            }
        } else {
            $waterSourceData = HouseHoldSourceWater::where("user_id", $userData->id)
                ->where("source_water_id", $request->source_water_id)
                ->first();
            if (empty($waterSourceData)) {
                $waterSourceData = new HouseHoldSourceWater;
            }

            $waterSourceData->user_id = $userData->id;
            $waterSourceData->source_water_id = $request->source_water_id;
            $waterSourceData->drinking = !empty($request->drinking) ? $request->drinking : 0;
            $waterSourceData->cooking = !empty($request->cooking) ? $request->cooking : 0;
            $waterSourceData->laundry = !empty($request->laundry) ? $request->laundry : 0;
            $waterSourceData->save();
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

    public function getWallList(Request $request) {
        $list = Wall::select(
            'id',
            'description'
        )
        ->get();

        return customResponse()
            ->message("List of constructions materials of the outer walls.")
            ->data($list)
            ->success()
            ->generate();
    }

    public function getBuildingHouseRepair(Request $request) {
        $list = BuildingHouseRepair::select(
            'id',
            'description'
        )
        ->get();

        return customResponse()
            ->message("List of building/house repair.")
            ->data($list)
            ->success()
            ->generate();
    }

    public function getYearBuiltList(Request $request) {
        $list = YearBuilt::select(
            'id',
            'description'
        )
        ->get();

        return customResponse()
            ->message("List of year built.")
            ->data($list)
            ->success()
            ->generate();
    }
    
    public function getFloorArea(Request $request) {
        $list = FloorArea::select(
            'id',
            'description'
        )
        ->get();

        return customResponse()
            ->message("List of floor area.")
            ->data($list)
            ->success()
            ->generate();
    }

    public function getLightingList(Request $request) {
        $list = Lighting::select(
            'id',
            'description'
        )
        ->get();

        return customResponse()
            ->message("List of lighting.")
            ->data($list)
            ->success()
            ->generate();
    }

    public function getCookingList(Request $request) {
        $list = Cooking::select(
            'id',
            'description'
        )
        ->get();

        return customResponse()
            ->message("List of cooking.")
            ->data($list)
            ->success()
            ->generate();
    }

    public function getHouseStatusList(Request $request) {
        $list = HouseStatus::select(
            'id',
            'description'
        )
        ->get();

        return customResponse()
            ->message("List of house status.")
            ->data($list)
            ->success()
            ->generate();
    }

    public function getHouseAcquisitionList(Request $request) {
        $list = HouseAcquisition::select(
            'id',
            'description'
        )
        ->get();

        return customResponse() 
            ->message("List of acquisition of the housing unit.")
            ->data($list)
            ->success()
            ->generate();
    }

    public function getHouseFinancingSource(Request $request) {
        $list = HouseFinancingSource::select(
            'id',
            'description'
        )
        ->get();

        return customResponse() 
            ->message("List of house financing source.")
            ->data($list)
            ->success()
            ->generate();
    }

    public function getMonthlyRental(Request $request) {
        $list = MonthlyRental::select(
            'id',
            'description'
        )
        ->get();

        return customResponse() 
            ->message("List of monthly rental.")
            ->data($list)
            ->success()
            ->generate();
    }

    public function getLotStatusList(Request $request) {
        $list = LotStatus::select(
            'id',
            'description'
        )
        ->get();

        return customResponse() 
            ->message("List of lot status.")
            ->data($list)
            ->success()
            ->generate();
    }

    public function getGarbageDisposal(Request $request) {
        $list = GarbageDisposal::select(
            'id',
            'description'
        )
        ->get();

        return customResponse() 
            ->message("List of garbage disposal.")
            ->data($list)
            ->success()
            ->generate();
    }

    public function getToiletFacility(Request $request) {
        $list = ToiletFacility::select(
            'id',
            'description'
        )
        ->get();

        return customResponse() 
            ->message("List of toilet facility.")
            ->data($list)
            ->success()
            ->generate();
    }
    
    public function getGarageAndParkingList(Request $request) {
        return customResponse() 
            ->message("Radio garage and parking.")
            ->data(Helpers::getGarageAndParkingList())
            ->success()
            ->generate();
    }

    public function getSepticTankStatusList(Request $request) {
        return customResponse() 
            ->message("Radio septic tank status.")
            ->data(Helpers::getSepticTankStatusList())
            ->success()
            ->generate();
    }
}
