<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyRental extends Model
{
    protected $table = 'monthly_rental';
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
        'description',
    ];
}
