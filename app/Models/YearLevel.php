<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YearLevel extends Model
{
    protected $table = 'year_level';
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
        'level_id',
        'level_code',
        'description',
    ];
}
