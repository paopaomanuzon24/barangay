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
        'alcohol_no',
        'alcohol_status',
        'comorbidity',
        'other_medical_history',
        // 'active_medical_condition',
        // 'active_medication',
        'allergies'
        // 'vaccination'
    ];

    public function medicalHistoryDisease() {
        return $this->hasMany(MedicalHistoryDisease::class, 'medical_history_id', 'id');
    }

    public function medicalActiveCondition() {
        return $this->hasMany(MedicalActiveCondition::class, 'medical_history_id', 'id');
    }

    public function medicalHistoryVaccine() {
        return $this->hasMany(MedicalHistoryVaccine::class, 'medical_history_id', 'id');
    }
}
