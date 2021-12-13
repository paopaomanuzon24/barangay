<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmploymentData extends Model
{
    protected $table = 'employment_data';
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
        'usual_occupation_id',
        'class_worker_id',
        'work_affiliation_id',
        'place_work_type',
        'place_work_type_specify',
        'employment_type',
        'employment',
        'employment_address',
        'monthly_income',
        'annual_income'
    ];
}
