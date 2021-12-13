<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'last_name',
        'middle_name',
        'first_name',
        'email',
        'contact_no',
        'gender',
        'address',
        'barangay_id',
        'password',
        'user_type_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sessionToken() {
        return $this->hasOne(SessionToken::class, 'user_id', 'id');
    }

    public function personalData() {
        return $this->hasOne(PersonalData::class, 'user_id', 'id');
    }

    public function otherData() {
        return $this->hasOne(OtherData::class, 'user_id', 'id');
    }

    public function addressData() {
        return $this->hasOne(AddressData::class, 'user_id', 'id');
    }

    public function employmentData() {
        return $this->hasOne(EmploymentData::class, 'user_id', 'id');
    }

    public function educationalData() {
        return $this->hasMany(EducationalData::class, 'user_id', 'id');
    }

    public function educationalOtherData() {
        return $this->hasOne(EducationalOtherData::class, 'user_id', 'id');
    }

    public function familyData() {
        return $this->hasMany(FamilyData::class, 'user_id', 'id');
    }

    public function residenceApplicationStatus() {
        return $this->hasOne(ResidenceApplication::class, 'user_id', 'id');
    }

    public function profilePicture() {
        return $this->hasOne(ProfilePicture::class, 'user_id', 'id');
    }
}
