<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseAcquisition extends Model
{
    protected $table = 'house_acquisition';
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
