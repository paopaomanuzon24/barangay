<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherDataLanguage extends Model
{
    protected $table = 'other_data_language';
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
        'other_data_id',
        'language_id'
    ];
}
