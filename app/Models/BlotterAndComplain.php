<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlotterAndComplain extends Model
{
    protected $table = 'blotter_and_complain_data';
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
        'barangay_id',
        'blotter_type_id',
        'blotter_status_id',
        'blotter_complaint_content',
        'blotter_date_resolved',
        'blotter_no',
        'blotter_amount'
    ];
}
