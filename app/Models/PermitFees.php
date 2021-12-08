<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermitFees extends Model
{
    use HasFactory;

    protected $table = 'permit_fees';
    protected $dateformat = 'Y-m-d H:i:s';
    public $timestamps = true;

    protected $fillable = [
        'permit_type_id','fee','amendment'
    ];
    protected $primaryKey = 'id';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
