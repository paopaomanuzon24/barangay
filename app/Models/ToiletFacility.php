<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToiletFacility extends Model
{
    protected $table = 'toilet_facility';
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
