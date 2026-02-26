<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bread extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'stock',
        'is_available',
        'type',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean',
    ];

    // Define relationship with order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the image URL - hỗ trợ cả ảnh từ public/images/breads và storage
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }

        // Nếu ảnh bắt đầu bằng "images/", lấy từ public/images/breads
        if (str_starts_with($this->image, 'images/')) {
            return asset($this->image);
        }

        // Nếu không, lấy từ storage (ảnh upload)
        return asset('storage/' . $this->image);
    }
}
