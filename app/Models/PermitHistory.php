<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermitHistory extends Model
{
    use HasFactory;

    protected $table = 'permit_history';
    protected $dateformat = 'Y-m-d H:i:s';
    public $timestamps = true;

    protected $fillable = [
        'permit_type_id','category_id','barangay_id','template_id','control_number','user_id','payment_method_id','status_id','release_date','file_name','file_path','reference_number','is_waive','waive_reason','application_id','feedback'
    ];
    protected $primaryKey = 'id';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function category()
    {
        return $this->belongsTo(PermitCategory::class, 'category_id', 'id');
    }

    public function barangay(){
        return $this->belongsTo(Barangay::class,'barangay_id','id');
    }

    public function permitType(){
        return $this->belongsTo(PermitType::class,'permit_type_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function paymentMethod(){
        return $this->belongsTo(PermitPaymentMethod::class,'payment_method_id','id');
    }

    public function status(){
        return $this->belongsTo(PermitStatus::class,'status_id','id');
    }



}
