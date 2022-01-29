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
        'first_name','middle_name','last_name','position_id','file_name','file_path','contact_no','address'
    ];
    protected $primaryKey = 'id';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function scopeProfileByName($query, $firstName,$middleName,$lastName)
    {
        return $query->where('first_name', $firstName)->where("middle_name",$middleName)->where("last_name",$lastName);
    }

    public function barangay(){
        return $this->belongsTo(Barangay::class,'barangay_id','id');
    }

    public function position()
    {
        return $this->belongsTo(BarangayPosition::class, 'position_id', 'id');
    }
}
