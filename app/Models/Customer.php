<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $table = 'customers';
    protected $fillable = [
        'avatar',
        'fullname',
        'email',
        'mobile',
        'birthday',
        'gender',
        'password',
        'status',
        'type',
        'created_at',
        'updated_at',
    ];

    /**
     * Hàm lấy địa chỉ người dùng
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function address()
    {
        return $this->hasMany('App\Models\Address');
    }

    /**
     * Hàm lấy dữ liệu đơn hàng người dùng
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function order()
    {
        return $this->hasMany('App\Models\Order');
    }

    /**
     * Hàm lấy thông tin sản phẩm trong giỏ hàng của khách hàng
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function food()
    {
        return $this->belongsToMany(
            'App\Models\Food', 'carts' , 'customer_id', 'food_id')
            ->using('App\Models\Cart')
            ->withPivot([
                'customer_id',
                'food_id',
                'quantity',
                'created_at',
                'updated_at',
            ]);
    }
//    /**
//     * Hàm lấy thông tin các mã giảm giá của khách hàng
//     *
//     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
//     */
//    public function voucher()
//    {
//        return $this->belongsToMany(
//            'App\Models\Voucher', 'customer_voucher' , 'customer_id', 'voucher_id')
//            ->using('App\Models\CustomerVoucher')
//            ->withPivot([
//                'customer_id',
//                'voucher_id',
//                'created_at',
//                'updated_at',
//            ]);
//    }
}
