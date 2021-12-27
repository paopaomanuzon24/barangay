<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseHoldInternetAccess extends Model
{
    protected $table = 'house_hold_internet_access';
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
        'internet_access_id'
    ];
}
