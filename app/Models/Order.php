<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $garded = [];


    function products()
    {
        return $this->belongsToMany(User::class, 'orders_products', 'order_id', 'product_id')->withPivot('quantity');
    }
}
