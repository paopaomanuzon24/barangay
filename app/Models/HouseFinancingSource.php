<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseFinancingSource extends Model
{
    protected $table = 'house_financing_source';
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
