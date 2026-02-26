<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bread;

class BreadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $breads = [
            [
                'name' => 'Bánh Mì Pate',
                'description' => 'Bánh mì pate truyền thống với pate gan thơm ngon và rau thơm, dưa chuột',
                'price' => 20000,
                'stock' => 50,
            ],
            [
                'name' => 'Bánh Mì Thịt Nướng',
                'description' => 'Bánh mì thịt nướng thơm ngon với nước sốt đậm đà',
                'price' => 25000,
                'stock' => 40,
            ],
            [
                'name' => 'Bánh Mì Trứng',
                'description' => 'Bánh mì trứng ốp la chiên giòn, rau thơm tươi ngon',
                'price' => 15000,
                'stock' => 60,
            ],
            [
                'name' => 'Bánh Mì Chả Lụa',
                'description' => 'Bánh mì chả lụa với dưa chuột và pate',
                'price' => 18000,
                'stock' => 45,
            ],
            [
                'name' => 'Bánh Mì Xíu Mại',
                'description' => 'Bánh mì xíu mại nóng hổi với sốt cà chua đậm đà',
                'price' => 22000,
                'stock' => 30,
            ],
            [
                'name' => 'Bánh Mì Gà Nướng',
                'description' => 'Bánh mì gà nướng thơm lừng với rau sống và nước sốt đặc biệt',
                'price' => 27000,
                'stock' => 35,
            ],
            [
                'name' => 'Bánh Mì Bò Kho',
                'description' => 'Bánh mì bò kho với nước dùng đậm đà và thịt bò mềm',
                'price' => 30000,
                'stock' => 25,
            ],
            [
                'name' => 'Bánh Mì Thập Cẩm',
                'description' => 'Bánh mì thập cẩm với nhiều loại nhân phong phú',
                'price' => 35000,
                'stock' => 50,
            ],
            [
                'name' => 'Bánh Mì Chả Cá',
                'description' => 'Bánh mì chả cá thơm ngon với rau sống và nước mắm chua ngọt',
                'price' => 24000,
                'stock' => 40,
            ],
            [
                'name' => 'Bánh Mì Heo Quay',
                'description' => 'Bánh mì heo quay giòn rụm với rau thơm và nước sốt đặc biệt',
                'price' => 32000,
                'stock' => 40,
            ],
            [
                'name' => 'Bánh Mì Xúc Xích',
                'description' => 'Bánh mì xúc xích nóng hổi với rau sống và sốt mayonnaise',
                'price' => 21000,
                'stock' => 55,
            ],
            [
                'name' => 'Bánh Mì Chảo',
                'description' => 'Bánh mì chảo với trứng ốp la, pate và xúc xích',
                'price' => 40000,
                'stock' => 40,
            ],
            [
                'name' => 'Bánh Mì Trứng Ngải Cứu',
                'description' => 'Bánh mì trứng ngải cứu thơm ngon và bổ dưỡng',
                'price' => 18000,
                'stock' => 50,
            ],
            [
                'name' => 'Bánh Mì Nướng Muối Ớt',
                'description' => 'Bánh mì nướng muối ớt giòn rụm, cay cay hấp dẫn',
                'price' => 16000,
                'stock' => 60,
            ],
            [
                'name' => 'Bánh Mì Que Hải Phòng',
                'description' => 'Bánh mì nhỏ gọn, thuôn dài với lớp vỏ mỏng, ăn với pate gan béo thơm',
                'price' => 5000,
                'stock' => 200,
            ],
            [
                'name' => 'Bánh Mì Kem',
                'description' => 'Bánh mì với kem thơm ngon',
                'price' => 20000,
                'stock' => 30,
            ],
        ];

        foreach ($breads as $bread) {
            Bread::create($bread);
        }
    }
}
