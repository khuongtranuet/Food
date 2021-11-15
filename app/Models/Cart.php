<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Cart extends Pivot
{
    protected $table = 'carts';
    protected $fillable = ['customer_id', 'food_id', 'quantity', 'created_at', 'updated_at'];


}
