<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $table = 'wards';
    protected $fillable = ['name', 'code', 'type', 'district_code', 'province_code', 'province_id', 'district_id', 'full_location'];

    /**
     * Hàm địa chỉ theo Xã/Phường
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function address()
    {
        return $this->hasMany('App\Models\Address');
    }
}
