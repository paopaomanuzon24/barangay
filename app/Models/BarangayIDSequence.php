<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangayIDSequence extends Model
{
    protected $table = 'barangay_id_sequence';
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
        'barangay_id',
        'current_year',
        'sequence'
    ];
}
