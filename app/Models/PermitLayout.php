<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermitLayout extends Model
{
    use HasFactory;

    protected $table = 'permit_layout';
    protected $dateformat = 'Y-m-d H:i:s';
    public $timestamps = true;

    protected $fillable = [
        'template_id','barangay_id','signatory','barangay_position','barangay_address','barangay_hotline','barangay_email'
    ];
    protected $primaryKey = 'id';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public function barangay(){
        return $this->belongsTo(Barangay::class,'barangay_id','id');
    }

}
