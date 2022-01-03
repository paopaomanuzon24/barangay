<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherData extends Model
{
    protected $table = 'other_data';
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
        'ethnicity_id',
        'disabled',
        'disability_id',
        'community',
        'community_id'
    ];

    public function language() {
        return $this->hasMany(OtherDataLanguage::class, 'other_data_id', 'id');
    }
}
