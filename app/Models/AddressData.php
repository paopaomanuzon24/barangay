<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddressData extends Model
{
    protected $table = 'address_data';
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
        'blk',
        'street',
        'barangay_id',
        'district',
        'zip_code',
        'full_address',
        'address_type',
        'temporary',
        'starting_from',
        'primary_id_path',
        'primary_id_name',
        'secondary_id_path',
        'secondary_id_name'
    ];
}
