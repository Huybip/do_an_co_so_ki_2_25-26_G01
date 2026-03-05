<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PromoCode;
use Carbon\Carbon;

class PromoCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PromoCode::create([
            'code' => 'WELCOME10',
            'discount_type' => 'percentage',
            'discount_value' => 10,
            'max_usage' => 100,
            'used_count' => 0,
            'expires_at' => Carbon::now()->addMonths(3),
            'is_active' => true,
            'description' => 'Giảm 10% cho khách hàng mới',
        ]);

        PromoCode::create([
            'code' => 'SUMMER50K',
            'discount_type' => 'fixed',
            'discount_value' => 50000,
            'max_usage' => 50,
            'used_count' => 0,
            'expires_at' => Carbon::now()->addMonths(2),
            'is_active' => true,
            'description' => 'Giảm 50.000đ cho đơn hàng trên 200.000đ',
        ]);

        PromoCode::create([
            'code' => 'VIP20',
            'discount_type' => 'percentage',
            'discount_value' => 20,
            'max_usage' => 200,
            'used_count' => 0,
            'expires_at' => Carbon::now()->addMonths(6),
            'is_active' => true,
            'description' => 'Giảm 20% cho thành viên VIP',
        ]);

        PromoCode::create([
            'code' => 'LIMITED100K',
            'discount_type' => 'fixed',
            'discount_value' => 100000,
            'max_usage' => 10,
            'used_count' => 0,
            'expires_at' => Carbon::now()->addDays(7),
            'is_active' => true,
            'description' => 'Khuyến mãi hạn chế: Giảm 100.000đ (chỉ 10 lần)',
        ]);
    }
}
