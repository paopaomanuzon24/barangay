<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermitStatus extends Model
{
    use HasFactory;

    protected $table = 'permit_status';
    protected $dateformat = 'Y-m-d H:i:s';
    public $timestamps = true;

    protected $fillable = [
        'description'
    ];
    protected $primaryKey = 'id';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const FOR_APPROVAL_STATUS = 1;
    const FOR_PAYMENT_STATUS = 3;
}
