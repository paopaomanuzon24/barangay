<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefCity extends Model
{
    protected $table = 'ref_cities';
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
        'city_code',
        'city_name',
        'reg_code',
        'prov_code',
        'nscb_city_code',
        'nscb_city_name',
        'city_classification',
        'chartered'
    ];
}
