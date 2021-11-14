<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    protected $fillable = ['name', 'code', 'type', 'province_id', 'province_code', 'admission_code'];

    /**
     * Hàm địa chỉ theo Quận/Huyện
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function address()
    {
        return $this->hasMany('App\Models\Address');
    }
}
