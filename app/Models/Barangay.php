<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    protected $table = 'barangays';
    public $timestamps = true;
    public $incrementing = true;
    protected $connection = 'mysql';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','description','is_barangay_system'
    ];

    public function scopefromBarangaySystem($query){
        return $query->where("barangays.is_barangay_system",1);
    }
}
