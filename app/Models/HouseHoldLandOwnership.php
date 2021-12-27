<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseHoldLandOwnership extends Model
{
    protected $table = 'house_hold_land_ownership';
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
        'land_ownership_id'
    ];
}
