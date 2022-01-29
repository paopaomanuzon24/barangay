<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeightType extends Model
{
    protected $table = 'height_type';
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
