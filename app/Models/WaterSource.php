<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaterSource extends Model
{
    protected $table = 'source_water';
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
        'description'
    ];
}
