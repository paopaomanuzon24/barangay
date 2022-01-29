<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncidentData extends Model
{
    protected $table = 'incident_data';
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
        'incident_type_id',
        'incident_message',
        'incident_address',
        'incident_latitude',
        'incident_longitude'
    ];
}
