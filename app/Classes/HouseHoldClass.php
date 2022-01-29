<?php

namespace App\Classes;

use Carbon\Carbon;

use App\Http\Controllers\Controller;

use App\Models\HouseHoldSourceWater;
use App\Models\HouseHoldLandOwnership;
use App\Models\HouseHoldPresence;
use App\Models\HouseHoldInternetAccess;
use App\Models\HouseHold;
use App\Models\User;

class HouseHoldClass
{
    public function saveHouseHold($request) {
        $controller = new Controller;
        $userData = $controller->userData($request->user_id);

        $houseHoldData = $userData->houseHold;
        if (empty($houseHoldData)) {
            $houseHoldData = new HouseHold;
            $houseHoldData->user_id = $userData->id;
        }

        $step = (INT) $request->step;
        switch ($step) {
            case 1:
                $params = [];
        
                $validator = $controller->validator($request, $params);
                if ($validator['status']) {
                    return $validator;
                    break;
                }
                
                $houseHoldData->type_building_house_id = !empty($request->type_building_house_id) ? $request->type_building_house_id : 0;
                $houseHoldData->roof_id = !empty($request->roof_id) ? $request->roof_id : 0;
                $houseHoldData->roof_specify = !empty($request->roof_specify) ? $request->roof_specify : "";
                $houseHoldData->outer_wall_id = !empty($request->outer_wall_id) ? $request->outer_wall_id : 0;
                $houseHoldData->outer_wall_specify = !empty($request->outer_wall_specify) ? $request->outer_wall_specify : "";
                $houseHoldData->state_repair_id = !empty($request->state_repair_id) ? $request->state_repair_id : 0;
                $houseHoldData->year_built_id = !empty($request->year_built_id) ? $request->year_built_id : 0;
                $houseHoldData->floor_area_id = !empty($request->floor_area_id) ? $request->floor_area_id : 0;
                $houseHoldData->lighting_id = !empty($request->lighting_id) ? $request->lighting_id : 0;
                $houseHoldData->cooking_id = !empty($request->cooking_id) ? $request->cooking_id : 0;
                $houseHoldData->other_source_water = !empty($request->other_source_water) ? $request->other_source_water : "";
                $houseHoldData->is_voter = !empty($request->is_voter) ? $request->is_voter : (!empty($houseHoldData->is_voter) ? $houseHoldData->is_voter : 0);
                $houseHoldData->save();

                // $this->saveWaterSource($request, $houseHoldData);
                break;
            case 2:
                $params = [];
        
                $validator = $controller->validator($request, $params);
                if ($validator['status']) {
                    return $validator;
                    break;
                }

                $houseHoldData->house_status_id = !empty($request->house_status_id) ? $request->house_status_id : 0;
                $houseHoldData->house_acquisition_id = !empty($request->house_acquisition_id) ? $request->house_acquisition_id : 0;
                $houseHoldData->house_acquisition_specify = !empty($request->house_acquisition_specify) ? $request->house_acquisition_specify : "";
                $houseHoldData->house_finance_id = !empty($request->house_finance_id) ? $request->house_finance_id : 0;
                $houseHoldData->house_finance_specify = !empty($request->house_finance_specify) ? $request->house_finance_specify : "";
                $houseHoldData->house_rental_id = !empty($request->house_rental_id) ? $request->house_rental_id : 0;
                $houseHoldData->lot_status_id = !empty($request->lot_status_id) ? $request->lot_status_id : 0;
                $houseHoldData->garbage_disposal_id = !empty($request->garbage_disposal_id) ? $request->garbage_disposal_id : 0;
                $houseHoldData->garbage_disposal_specify = !empty($request->garbage_disposal_specify) ? $request->garbage_disposal_specify : "";
                $houseHoldData->toilet_facility_id = !empty($request->toilet_facility_id) ? $request->toilet_facility_id : 0;
                $houseHoldData->language = !empty($request->language) ? $request->language : "";
                $houseHoldData->residence_type = !empty($request->residence_type) ? $request->residence_type : "";
                $houseHoldData->is_voter = !empty($request->is_voter) ? $request->is_voter : (!empty($houseHoldData->is_voter) ? $houseHoldData->is_voter : 0);
                $houseHoldData->save();

                $this->saveLandOwnership($request, $houseHoldData);
                $this->savePresenceHouseHold($request, $houseHoldData);
                break;
            case 3:
                $params = [
                    // 'septic_tank' => 'required',
                    'house_photo' => 'mimes:jpg,bmp,png,jpeg'
                ];
        
                $validator = $controller->validator($request, $params);
                if ($validator['status']) {
                    return $validator;
                    break;
                }

                $houseHoldData->garage_parking = !empty($request->garage_parking) ? $request->garage_parking : "";
                $houseHoldData->septic_tank = !empty($request->septic_tank) ? $request->septic_tank : "";
                $houseHoldData->septic_tank_specify = !empty($request->septic_tank_specify) ? $request->septic_tank_specify : "";
                $houseHoldData->is_voter = !empty($request->is_voter) ? $request->is_voter : (!empty($houseHoldData->is_voter) ? $houseHoldData->is_voter : 0);
                if ($request->hasFile('house_photo')) {
                    $file = $request->file("house_photo");
                    
                    $path = 'images/house/document';
        
                    $image = $file;
                    $imageName = $image->getClientOriginalName();
        
                    $file->storeAs("public/".$path, $imageName);
                    
                    $houseHoldData->path_name = $path.'/'.$imageName;
                    $houseHoldData->file_name = $imageName;
                }
                $houseHoldData->save();

                $this->saveInternetAccess($request, $houseHoldData);
                break;
        }
    }

    // protected function saveWaterSource($request, $houseHoldData) {
    //     $this->deleteHouseHoldSourceWater($houseHoldData->id);

    //     foreach ($request->drinking as $waterSourceID => $drinkVal) {
    //         $waterSourceData = HouseHoldSourceWater::where("house_hold_id", $houseHoldData->id)
    //             ->where("source_water_id", $waterSourceID)
    //             ->first();
    //         if (empty($waterSourceData)) {
    //             $waterSourceData = new HouseHoldSourceWater;
    //             $waterSourceData->house_hold_id = $houseHoldData->id;
    //         }
            
    //         $waterSourceData->source_water_id = $waterSourceID;
    //         $waterSourceData->drinking = !empty($drinkVal) ? $drinkVal : 0;
    //         $waterSourceData->cooking = !empty($waterSourceData->cooking) ? $waterSourceData->cooking : 0;
    //         $waterSourceData->laundry = !empty($waterSourceData->laundry) ? $waterSourceData->laundry : 0;
    //         $waterSourceData->save();
    //     }

    //     foreach ($request->cooking as $waterSourceID => $cookVal) {
    //         $waterSourceData = HouseHoldSourceWater::where("house_hold_id", $houseHoldData->id)
    //             ->where("source_water_id", $waterSourceID)
    //             ->first();
    //         if (empty($waterSourceData)) {
    //             $waterSourceData = new HouseHoldSourceWater;
    //             $waterSourceData->house_hold_id = $houseHoldData->id;
    //         }
            
    //         $waterSourceData->source_water_id = $waterSourceID;
    //         $waterSourceData->cooking = !empty($cookVal) ? $cookVal : 0;
    //         $waterSourceData->drinking = !empty($waterSourceData->drinking) ? $waterSourceData->drinking : 0;
    //         $waterSourceData->laundry = !empty($waterSourceData->laundry) ? $waterSourceData->laundry : 0;
    //         $waterSourceData->save();
    //     }

    //     foreach ($request->laundry as $waterSourceID => $laundryVal) {
    //         $waterSourceData = HouseHoldSourceWater::where("house_hold_id", $houseHoldData->id)
    //             ->where("source_water_id", $waterSourceID)
    //             ->first();
    //         if (empty($waterSourceData)) {
    //             $waterSourceData = new HouseHoldSourceWater;
    //             $waterSourceData->house_hold_id = $houseHoldData->id;
    //         }
            
    //         $waterSourceData->source_water_id = $waterSourceID;
    //         $waterSourceData->laundry = !empty($laundryVal) ? $laundryVal : 0;
    //         $waterSourceData->cooking = !empty($waterSourceData->cooking) ? $waterSourceData->cooking : 0;
    //         $waterSourceData->drinking = !empty($waterSourceData->drinking) ? $waterSourceData->drinking : 0;
    //         $waterSourceData->save();
    //     }
    // }

    protected function saveLandOwnership($request, $houseHoldData) {
        $this->deleteHouseHoldLandOwnership($houseHoldData->id);

        foreach ($request->land_ownership_id as $key => $value) {
            $landOwnershipData = HouseHoldLandOwnership::where("house_hold_id", $houseHoldData->id)
                ->where("land_ownership_id", $value)
                ->first();

            if (empty($landOwnershipData)) {
                $landOwnershipData = new HouseHoldLandOwnership;
                $landOwnershipData->house_hold_id = $houseHoldData->id;
            }
            
            $landOwnershipData->land_ownership_id = $value;
            $landOwnershipData->save();
        }
    }

    protected function savePresenceHouseHold($request, $houseHoldData) {
        $this->deleteHouseHoldPresence($houseHoldData->id);
        
        foreach ($request->house_hold_presence_id as $key => $value) {
            $presenceData = HouseHoldPresence::where("house_hold_id", $houseHoldData->id)
                ->where("house_hold_presence_id", $value)
                ->first();

            if (empty($presenceData)) {
                $presenceData = new HouseHoldPresence;
                $presenceData->house_hold_id = $houseHoldData->id;
            }
            
            $presenceData->house_hold_presence_id = $value;
            $presenceData->save();
        }
    }

    protected function saveInternetAccess($request, $houseHoldData) {
        $this->deleteHouseHoldInternetAccess($houseHoldData->id);

        foreach ($request->internet_access_id as $key => $value) {
            $internetAccessData = HouseHoldInternetAccess::where("house_hold_id", $houseHoldData->id)
                ->where("internet_access_id", $value)
                ->first();

            if (empty($internetAccessData)) {
                $internetAccessData = new HouseHoldInternetAccess;
                $internetAccessData->house_hold_id = $houseHoldData->id;
            }
            
            $internetAccessData->internet_access_id = $value;
            $internetAccessData->save();
        }
    }

    // protected function deleteHouseHoldSourceWater($id) {
    //     HouseHoldSourceWater::where("house_hold_id", $id)->each(function($row){
    //         $row->delete();
    //     });
    // }
    
    protected function deleteHouseHoldLandOwnership($id) {
        HouseHoldLandOwnership::where("house_hold_id", $id)->each(function($row){
            $row->delete();
        });
    }

    protected function deleteHouseHoldPresence($id) {
        HouseHoldPresence::where("house_hold_id", $id)->each(function($row){
            $row->delete();
        });
    }

    protected function deleteHouseHoldInternetAccess($id) {
        HouseHoldInternetAccess::where("house_hold_id", $id)->each(function($row){
            $row->delete();
        });
    }
}
