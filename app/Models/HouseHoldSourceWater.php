<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseHoldSourceWater extends Model
{
    protected $table = 'house_hold_source_water';
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
        'house_hold_id',
        'source_water_id',
        'drinking',
        'cooking',
        'laundry'
    ];
}
