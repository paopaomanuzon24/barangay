<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseHoldPresence extends Model
{
    protected $table = 'house_hold_presence';
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
        'house_hold_presence_id'
    ];
}
