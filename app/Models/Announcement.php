<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $table = 'announcements';
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
        'barangay_id',
        'title',
        'content',
        'date_from',
        'date_to',
        'img_path',
        'img_name',
        'pinned',
        'created_by',
    ];
}
