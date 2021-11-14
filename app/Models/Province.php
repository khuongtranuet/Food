<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provinces';
    protected $fillable = ['name', 'code', 'type', 'zone'];

    /**
     * Hàm địa chỉ theo Tỉnh/Thành phố
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function address()
    {
        return $this->hasMany('App\Models\Address');
    }
}
