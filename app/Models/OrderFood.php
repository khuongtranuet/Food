<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderFood extends Pivot
{
    protected $table = 'order_food';
    protected $fillable = ['food_id', 'order_id', 'quantity', 'unit_price', 'total_price', 'created_at', 'updated_at'];
}
