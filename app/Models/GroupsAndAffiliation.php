<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupsAndAffiliation extends Model
{
    protected $table = 'groups_and_affiliation';
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
