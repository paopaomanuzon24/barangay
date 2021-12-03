<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class session extends Model
{


    protected $table = 'sessions';
    public $timestamps = true;
    public $incrementing = true;
    protected $connection = 'mysql';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'ip_address','user_agent','payload','last_activity'
    ];


}
