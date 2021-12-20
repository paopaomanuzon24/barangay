<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalHistory extends Model
{
    protected $table = 'medical_history';
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
        'height',
        'weight',
        'blood_type',
        'smoke_no',
        'alocohol_no',
        'alcohol_status',
        'commorbidity',
        'active_medical_condition',
        'active_medication',
        'allergies',
        'vaccination'
    ];

    public function medicalHistoryDisease() {
        return $this->hasOne(MedicalHistoryDisease::class, 'medical_history_id', 'id');
    }
}
