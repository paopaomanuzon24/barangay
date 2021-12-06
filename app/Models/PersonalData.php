<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalData extends Model
{
    protected $table = 'personal_data';
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
        'last_name',
        'first_name',
        'middle_name',
        'middle_name',
        'gender',
        'marital_status_id',
        'religious_id',
        'nationality',
        'nationality_id',
        'birth_date',
        'birth_place',
        'contact_no',
        'email'
    ];
}
