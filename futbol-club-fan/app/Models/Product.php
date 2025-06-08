<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function getFormattedPriceAttribute() {
        return '$' . number_format($this->price, 0, ',', '.');
    }
}
