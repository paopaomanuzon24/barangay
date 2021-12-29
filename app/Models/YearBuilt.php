<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YearBuilt extends Model
{
    protected $table = 'year_built';
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
