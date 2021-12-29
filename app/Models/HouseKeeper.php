<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseKeeper extends Model
{
    protected $table = 'house_keeper_data';
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
        'user_id',
        'house_keeper_type_id',
        'first_name',
        'middle_name',
        'last_name',
        'birth_date',
        'contact_no',
        'address',
        'same_address'
    ];
}
