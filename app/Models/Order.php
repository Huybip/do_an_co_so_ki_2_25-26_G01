<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_phone',
        'customer_address',
        'total_amount',
        'discount_amount',
        'promo_code_id',
        'status',
        'note',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'status' => 'string',
    ];

    // Define relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define relationship with order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Define relationship with promo code
    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class, 'promo_code_id');
    }
}
