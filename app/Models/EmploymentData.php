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
        'employment_type',
        'employment',
        'employment_address',
        'monthly_income',
        'annual_income'
    ];
}
