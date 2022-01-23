<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentFileData extends Model
{
    protected $table = 'document_file_data';
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
        'document_data_id',
        'file_name',
        'path_name'
    ];
}
