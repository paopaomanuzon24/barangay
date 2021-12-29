<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FloorArea extends Model
{
    protected $table = 'floor_area';
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
