<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResidenceApplication extends Model
{
    protected $table = 'residence_application';
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
        'status_id',
        'remarks'
    ];

    public function scopeApprovedResidence($query){
        return $query->where("status_id",1);
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function personalData() {
        return $this->hasOne(PersonalData::class, 'user_id', 'user_id');
    }

    public function otherData() {
        return $this->hasOne(OtherData::class, 'user_id', 'user_id');
    }
}
