<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangayIDGenerated extends Model
{
    protected $table = 'barangay_id_generated';
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
        'date_created',
        'date_expiration',
        'qrCode'
    ];
}
