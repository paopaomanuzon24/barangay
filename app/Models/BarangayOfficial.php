<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangayOfficial extends Model
{
    use HasFactory;

    protected $table = 'barangay_official';
    protected $dateformat = 'Y-m-d H:i:s';
    public $timestamps = true;

    protected $fillable = [
        'first_name','middle_name','last_name','position_id','photo_file_name','photo_path'
    ];
    protected $primaryKey = 'id';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function scopeProfileByName($query, $firstName,$middleName,$lastName)
    {
        return $query->where('first_name', $firstName)->where("middle_name",$middleName)->where("last_name",$lastName);
    }
}
