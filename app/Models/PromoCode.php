<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PromoCode extends Model
{
    protected $fillable = [
        'code',
        'discount_type',
        'discount_value',
        'max_usage',
        'used_count',
        'expires_at',
        'is_active',
        'description'
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'expires_at' => 'datetime',
    ];

    // Kiểm tra mã có hợp lệ hay không
    public function isValid()
    {
        // Kiểm tra trạng thái
        if (!$this->is_active) {
            return false;
        }

        // Kiểm tra hạn sử dụng
        if ($this->expires_at && Carbon::now() > $this->expires_at) {
            return false;
        }

        // Kiểm tra số lần sử dụng
        if ($this->max_usage && $this->used_count >= $this->max_usage) {
            return false;
        }

        return true;
    }

    // Tính toán số tiền giảm giá
    public function calculateDiscount($subtotal)
    {
        if ($this->discount_type === 'percentage') {
            return ($subtotal * $this->discount_value) / 100;
        }
        return min($this->discount_value, $subtotal); // Không giảm quá tổng tiền
    }

    // Relationship với orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
