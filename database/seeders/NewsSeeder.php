<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'title' => 'Giảm giá cuối tuần: Mua 2 tặng 1',
                'excerpt' => 'Chương trình giảm giá đặc biệt cho khách hàng cuối tuần.',
                'content' => 'Mua hai ổ bánh bất kỳ, nhận ngay một ổ tặng kèm. Áp dụng từ Thứ 6 đến Chủ nhật.',
                'is_published' => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Sản phẩm mới: Bánh matcha nhân trà xanh',
                'excerpt' => 'Thưởng thức hương vị matcha đậm đà trong chiếc bánh mới của chúng tôi.',
                'content' => 'Bánh matcha nhân trà xanh được làm từ bột matcha cao cấp và nhân kem mịn, phù hợp cho mọi dịp.',
                'is_published' => true,
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'Thông báo nghỉ lễ',
                'excerpt' => 'Cửa hàng tạm nghỉ nhân dịp lễ sắp tới.',
                'content' => 'Cửa hàng sẽ đóng cửa vào ngày lễ. Mọi đơn hàng online sẽ xử lý vào ngày làm việc tiếp theo.',
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Hướng dẫn bảo quản bánh tươi',
                'excerpt' => 'Mẹo để giữ bánh tươi ngon lâu hơn.',
                'content' => 'Để bảo quản bánh tươi, hãy giữ chúng trong hộp kín và đặt ở nơi thoáng mát. Tránh ánh nắng trực tiếp.',
                'is_published' => true,
                'published_at' => now()->subDays(15),
            ],
            [
                'title' => 'Sự kiện khai trương chi nhánh mới',
                'excerpt' => 'Chúng tôi hân hoan thông báo khai trương chi nhánh mới.',
                'content' => 'Tham gia sự kiện khai trương chi nhánh mới của chúng tôi với nhiều ưu đãi hấp dẫn và quà tặng đặc biệt.',
                'is_published' => true,
                'published_at' => now()->subDays(20),
            ],
            [
                'title' => 'Công thức bánh mì tự làm tại nhà',
                'excerpt' => 'Hướng dẫn chi tiết để bạn có thể làm bánh mì tươi ngon ngay tại nhà.',
                'content' => 'Công thức đơn giản với nguyên liệu dễ tìm, giúp bạn tạo ra những ổ bánh mì thơm ngon và giòn tan.',
                'is_published' => true,
                'published_at' => now()->subDays(25),
            ],
            [
                'title' => 'Khuyến mãi đặc biệt cho sinh viên',
                'excerpt' => 'Giảm giá 15% cho tất cả sinh viên khi mua bánh tại cửa hàng.',
                'content' => 'Sinh viên chỉ cần xuất trình thẻ sinh viên để nhận ưu đãi giảm giá 15% cho tất cả các loại bánh tại cửa hàng.',
                'is_published' => true,
                'published_at' => now()->subDays(30),
            ],
        ];

        foreach ($items as $data) {
            $data['slug'] = Str::slug($data['title']) . '-' . Str::random(5);
            News::create($data);
        }
    }
}
