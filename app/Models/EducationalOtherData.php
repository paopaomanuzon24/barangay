<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationalOtherData extends Model
{
    protected $table = 'educational_other_data';
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
        'course_id'
    ];
}
