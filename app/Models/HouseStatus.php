<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseStatus extends Model
{
    protected $table = 'house_status';
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
