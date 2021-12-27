<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Convenience extends Model
{
    protected $table = 'conveniences';
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
        'description'
    ];
}
