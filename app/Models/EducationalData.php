<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationalData extends Model
{
    protected $table = 'educational_data';
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
        'level_id', 
        'level_code', 
        'course_id', 
        'school_name', 
        'school_address', 
        'year_from', 
        'year_to'
    ];
}
