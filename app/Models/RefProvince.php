<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefProvince extends Model
{
    protected $table = 'ref_provinces';
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
        'prov_code',
        'prov_name',
        'reg_code',
        'nscb_prov_code',
        'nscb_prov_name'
    ];
}
