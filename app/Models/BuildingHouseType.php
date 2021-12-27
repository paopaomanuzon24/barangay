<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuildingHouseType extends Model
{
    protected $table = 'building_house_type';
    public $timestamps = true;
    public $incrementing = true;
    protected $connection = 'mysql';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','description'
    ];
}
