<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccountStatus extends Model
{
    use HasFactory;

    protected $table = 'user_account_statuses';

    protected $fillable = [
        'user_id', 'is_active', 'remarks', 'created_by'
    ];
    protected $primaryKey = 'id';

    public function userAccount() {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function createdBy() {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }
}
