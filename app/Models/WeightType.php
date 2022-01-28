<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeightType extends Model
{
    protected $table = 'weight_type';
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
