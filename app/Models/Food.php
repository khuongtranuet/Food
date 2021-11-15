<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';
    protected $fillable = ['category_id', 'name', 'slug', 'price', 'description', 'image_path', 'created_at', 'updated_at'];

    /**
     * Hàm lấy thông tin danh mục
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    /**
     * Hàm lấy thông tin các đơn hàng của sản phẩm
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function order()
    {
        return $this->belongsToMany(
            'App\Models\Order', 'order_food' , 'food_id', 'order_id')
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

    /**
     * Hàm lấy thông tin các khách hàng đang lưu sản phẩm trong giỏ hàng
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function customer()
    {
        return $this->belongsToMany(
            'App\Models\Customer', 'carts' , 'food_id', 'customer_id')
            ->using('App\Models\Cart')
            ->withPivot([
                'customer_id',
                'food_id',
                'quantity',
                'created_at',
                'updated_at',
            ]);
    }
}
