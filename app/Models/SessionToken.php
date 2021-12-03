<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class SessionToken extends Model
{


    protected $table = 'session_token';
    public $timestamps = true;
    public $incrementing = true;
    protected $connection = 'mysql';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','user_id', 'session_id','token'
    ];




}
