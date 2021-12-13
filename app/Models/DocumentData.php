<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentData extends Model
{
    protected $table = 'document_data';
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
        'document_id',
        'file_name',
        'path_name',
        'status_id'
    ];
}
