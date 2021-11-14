<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    protected $fillable = ['customer_id', 'province_id', 'district_id', 'ward_id', 'address', 'fullname',
        'mobile', 'type', 'status', 'created_at', 'updated_at'];

    /**
     * Hàm lấy thông tin khách hàng
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
    }

    /**
     * Hàm lấy thông tin Tỉnh/Thành phố
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province()
    {
        return $this->belongsTo('App\Models\Province', 'province_id', 'id');
    }

    /**
     * Hàm lấy thông tin Quận/Huyện
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo('App\Models\District', 'district_id', 'id');
    }

    /**
     * Hàm lấy thông tin Xã/Phường
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ward()
    {
        return $this->belongsTo('App\Models\Ward', 'ward_id', 'id');
    }

    /**
     * Hàm lấy dữ liệu đơn hàng theo địa chỉ
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function order()
    {
        return $this->hasMany('App\Models\Order');
    }
}
