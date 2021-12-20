<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalHistoryDisease extends Model
{
    protected $table = 'medical_history_disease';
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
        'medical_history_id',
        'disease_id'
    ];
}
