<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClearanceStatus extends Model
{
    use HasFactory;

    protected $table = 'clearance_status';
    protected $dateformat = 'Y-m-d H:i:s';
    public $timestamps = true;

    protected $fillable = [
        'description'
    ];
    protected $primaryKey = 'id';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const FOR_APPROVAL_STATUS = 1;
    const FOR_RELEAST_STATUS = 2;
    const FOR_PAYMENT_STATUS = 3;
    const DENIED_STATUS = 4;
}
