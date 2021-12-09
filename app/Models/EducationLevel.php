<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationLevel extends Model
{
    protected $table = 'education_level';
    public $timestamps = true;
    public $incrementing = true;
    protected $connection = 'mysql';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'code', 'description', 'sort'
    ];
}
