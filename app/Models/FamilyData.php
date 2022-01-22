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
        'personal_data_id',
        'relationship_type_id'
    ];
}
