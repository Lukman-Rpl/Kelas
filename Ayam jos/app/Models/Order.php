<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_name','customer_address','order_details','total_price'];

   
// Order.php
public function user() {
    return $this->belongsTo(User::class);
}
public function menu() {
    return $this->belongsTo(Menu::class);
}

}

