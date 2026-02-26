<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'bread_id',
        'quantity',
        'price',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    // Define relationship with order
    public function order()
    {
        return $this->belongTo(Order::class);
    }

    // Define relationship with bread
    public function bread()
    {
        return $this->belongsTo(Bread::class);
    }
}
