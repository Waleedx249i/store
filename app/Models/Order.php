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

    function scopeTotalSaels()
    {
        $totalSaels = 0;
        $paidOrders = Order::all()->where('status', 'paid');
        foreach ($paidOrders as $order) {
            $totalSaels += $order->total_price;
        }
        return $totalSaels;
    }

    function scopeOrderCount()
    {

        $paidOrders = Order::all()->where('status', 'paid')->count();
        $unpaidOrders = Order::all()->where('status', 'unpaid')->count();
        $ordercount = [
            'paidOrders' => $paidOrders,
            'unpaidOrders' => $unpaidOrders,
            'totalOrders' => $paidOrders + $unpaidOrders

        ];
        return $ordercount;
    }
}
