<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClearanceSequence extends Model
{
    protected $table = 'permit_sequence';
    public $timestamps = true;
    public $incrementing = true;
    protected $connection = 'mysql';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','barangay_id','sequence'
    ];
}
