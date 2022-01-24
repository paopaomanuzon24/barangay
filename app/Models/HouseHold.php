<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseHold extends Model
{
    protected $table = 'house_hold_data';
    public $timestamps = true;
    public $incrementing = true;
    protected $connection = 'mysql';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'type_building_house_id',
        'roof_id',
        'roof_specify',
        'outer_wall_id',
        'outer_wall_specify',
        'state_repair_id',
        'year_built_id',
        'floor_area_id',
        'lighting_id',
        'cooking_id',
        'other_source_water',
        'house_status_id',
        'house_acquisition_id',
        'house_acquisition_specify',
        'house_finance_id',
        'house_finance_specify',
        'house_rental_id',
        'lot_status_id',
        'garbage_disposal_id',
        'garbage_disposal_specify',
        'toilet_facility_id',
        'language',
        'residence_type',
        // 'internet_access_type',
        'garage_parking',
        'septic_tank',
        'septic_tank_specify',
        'file_name',
        'path_name'
    ];

    // public function waterSource() {
    //     return $this->hasMany(HouseHoldSourceWater::class, 'house_hold_id', 'id');
    // }

    public function landOwnership() {
        return $this->hasMany(HouseHoldLandOwnership::class, 'house_hold_id', 'id');
    }

    public function presenceHouseHold() {
        return $this->hasMany(HouseHoldPresence::class, 'house_hold_id', 'id');
    }

    public function internetAccess() {
        return $this->hasMany(HouseHoldInternetAccess::class, 'house_hold_id', 'id');
    }
}
