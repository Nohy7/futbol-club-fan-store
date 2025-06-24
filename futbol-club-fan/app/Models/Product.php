<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category',
        'accessory',
        'price',
        'description',
        'stock',
        'url_image'
    ];

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_size');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getFormattedPriceAttribute() {
        return '$' . number_format($this->price, 0, ',', '.');
    }
}
