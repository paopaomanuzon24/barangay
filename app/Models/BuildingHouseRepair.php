<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuildingHouseRepair extends Model
{
    protected $table = 'building_house_repair';
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
        'description',
    ];
}
