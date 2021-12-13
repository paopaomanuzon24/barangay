<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamilyData extends Model
{
    protected $table = 'family_data';
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
        'relationship_type_id',
        'first_name',
        'middle_name',
        'last_name',
        'birth_date',
        'contact_no',
        'same_address',
        'address',
    ];
}
