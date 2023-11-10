<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $garded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function scopeWithFilters($query, $categories)
    {
        return $query->when(count($categories), function ($query) use ($categories) {
            $query->whereIn('category_id', $categories);
        });
    }
    function orders()
    {
        return $this->belongsToMany(User::class, 'orders_products', 'product_id', 'order_id')->withPivot('quantity');
    }
}
