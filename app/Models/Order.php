<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['customer_id', 'address_id', 'code', 'order_date', 'total_bill', 'discount',
        'transport_fee', 'ship_discount', 'total_pay', 'payment_method', 'payment_status', 'status', 'type', 'delete',
        'created_at', 'updated_at'];

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
     * Hàm lấy địa chỉ đơn hàng
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo('App\Models\Address', 'address_id', 'id');
    }

//    /**
//     * Hàm lấy thông tin kho hàng của đơn hàng đang xét
//     *
//     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
//     */
//    public function repository()
//    {
//        return $this->belongsTo('App\Models\Repository', 'repository_id', 'id');
//    }

    /**
     * Hàm lấy thông tin sản phẩm của đơn hàng
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function food()
    {
        return $this->belongsToMany(
            'App\Models\Food', 'order_food' , 'order_id', 'food_id')
            ->using('App\Models\OrderFood')
            ->withPivot([
                'food_id',
                'order_id',
                'quantity',
                'unit_price',
                'total_price',
                'created_at',
                'updated_at',
            ]);
    }

//    /**
//     * Hàm lấy thông tin mã giảm giá của đơn hàng
//     *
//     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
//     */
//    public function voucher()
//    {
//        return $this->belongsToMany(
//            'App\Models\Voucher', 'order_voucher' , 'order_id', 'voucher_id')
//            ->using('App\Models\OrderVoucher')
//            ->withPivot([
//                'order_id',
//                'voucher_id',
//                'created_at',
//                'updated_at',
//            ]);
//    }

//    public function shipped() {
//        return $this->hasOne('App\Models\Shipped', 'code', 'order_code');
//    }
}
