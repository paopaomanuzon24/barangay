<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermitCategory extends Model
{
    use HasFactory;

    protected $table = 'permit_category';
    protected $dateformat = 'Y-m-d H:i:s';
    public $timestamps = true;

    protected $fillable = [
        'description','barangay_id','fee','is_barangay_system'
    ];
    protected $primaryKey = 'id';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function scopefromBarangaySystem($query){
        return $query->where("permit_category.is_barangay_system",1);
    }
}
