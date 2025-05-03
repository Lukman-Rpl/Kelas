<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'title', 'description', 'price', 'image_url', 'category', 'stock'
    ];

    protected $casts = [
        'price' => 'float',
        'stock' => 'integer',
    ];
}
