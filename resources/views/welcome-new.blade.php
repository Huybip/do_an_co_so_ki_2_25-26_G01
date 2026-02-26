<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Bánh Mì Shop') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            :root {
                --bm-golden: #D4A373;
                --bm-coral: #E76F51;
                --bm-cream: #FAF3E0;
                --bm-dark: #2C2C2C;
            }
            body {
                background-color: var(--bm-cream);
                color: var(--bm-dark);
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
            /* Hero Section */
            .hero-section {
                background: linear-gradient(135deg, var(--bm-cream) 0%, #F5F2ED 100%);
                padding: 80px 20px;
                text-align: center;
            }
            .hero-title {
                font-size: 3.5rem;
                font-weight: 700;
                color: var(--bm-dark);
                margin-bottom: 20px;
            }
            .hero-subtitle {
                font-size: 1.3rem;
                color: #666;
                margin-bottom: 40px;
            }
            /* Category Section */
            .category-section {
                padding: 60px 20px;
                background: white;
            }
            .section-title {
                font-size: 2rem;
                font-weight: 700;
                text-align: center;
                margin-bottom: 50px;
                color: var(--bm-dark);
                position: relative;
                padding-bottom: 20px;
            }
            .section-title::after {
                content: '';
                position: absolute;
                width: 60px;
                height: 4px;
                background: var(--bm-coral);
                left: 50%;
                transform: translateX(-50%);
                bottom: 0;
                border-radius: 2px;
            }
            /* Product Card */
            .product-card {
                background: white;
                border-radius: 12px;
                overflow: hidden;
                transition: all 0.3s ease;
                border: 1px solid #eee;
                height: 100%;
            }
            .product-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 12px 24px rgba(212, 163, 115, 0.15);
            }
            .product-image {
                width: 100%;
                height: 220px;
                background: #f5f2ed;
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: hidden;
            }
            .product-image img {
                max-width: 100%;
                max-height: 100%;
                object-fit: contain;
            }
            .product-body {
                padding: 20px;
                text-align: center;
            }
            .product-name {
                font-weight: 600;
                font-size: 1.1rem;
                margin-bottom: 10px;
                color: var(--bm-dark);
            }
            .product-price {
                font-size: 1.3rem;
                font-weight: 700;
                color: var(--bm-coral);
                margin-bottom: 15px;
            }
            /* News/Promotion Card */
            .news-card {
                background: white;
                border-radius: 12px;
                overflow: hidden;
                transition: all 0.3s ease;
                height: 100%;
            }
            .news-card:hover {
                transform: translateY(-6px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            }
            .news-image {
                width: 100%;
                height: 180px;
                background: linear-gradient(135deg, var(--bm-golden), var(--bm-coral));
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 3rem;
            }
            .news-content {
                padding: 20px;
            }
            .news-title {
                font-weight: 600;
                font-size: 1.1rem;
                color: var(--bm-dark);
                margin-bottom: 8px;
            }
            .news-desc {
                color: #666;
                font-size: 0.95rem;
                line-height: 1.5;
            }
            /* Button Styles */
            .btn-primary-modern {
                background: var(--bm-golden);
                color: white;
                border: none;
                padding: 10px 24px;
                border-radius: 6px;
                font-weight: 600;
                transition: all 0.3s ease;
                display: inline-block;
                text-decoration: none;
            }
            .btn-primary-modern:hover {
                background: #C4956A;
                transform: translateY(-2px);
                box-shadow: 0 6px 16px rgba(212, 163, 115, 0.3);
                color: white;
            }
            .btn-secondary-modern {
                background: var(--bm-coral);
                color: white;
                border: none;
                padding: 10px 24px;
                border-radius: 6px;
                font-weight: 600;
                transition: all 0.3s ease;
                display: inline-block;
                text-decoration: none;
            }
            .btn-secondary-modern:hover {
                background: #D65A3E;
                transform: translateY(-2px);
                box-shadow: 0 6px 16px rgba(231, 111, 81, 0.3);
                color: white;
            }
            /* Navigation */
            .navbar-modern {
                background: white;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            }
            .nav-brand {
                font-weight: 700;
                font-size: 1.5rem;
                color: var(--bm-golden) !important;
            }
            /* Category Grid */
            .category-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 20px;
                margin-bottom: 60px;
            }
            .category-card {
                background: white;
                border-radius: 12px;
                padding: 30px 20px;
                text-align: center;
                border: 2px solid #eee;
                transition: all 0.3s ease;
                cursor: pointer;
            }
            .category-card:hover {
                border-color: var(--bm-coral);
                box-shadow: 0 8px 20px rgba(231, 111, 81, 0.1);
            }
            .category-icon {
                font-size: 3rem;
                margin-bottom: 15px;
            }
            .category-name {
                font-weight: 600;
                color: var(--bm-dark);
                font-size: 1.1rem;
            }
            /* Footer */
            .footer-section {
                background: var(--bm-dark);
                color: white;
                padding: 40px 20px;
                margin-top: 80px;
            }
        </style>
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-modern sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand nav-brand" href="/">🍞 Bánh Mì Shop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="#san-pham">Sản phẩm</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tin-tuc">Tin tức</a></li>
                        @auth
                            <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}">Giỏ hàng</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Tài khoản</a></li>
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="nav-link btn btn-link">Đăng xuất</button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Đăng nhập</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Đăng ký</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <h1 class="hero-title">Bánh Mì Tươi Ngon Hàng Ngày</h1>
                <p class="hero-subtitle">Khám phá bộ sưu tập bánh mì đa dạng của chúng tôi - từ bánh ngọt tinh tế đến bánh mặn hấp dẫn</p>
                <a href="#san-pham" class="btn-primary-modern" style="font-size: 1.1rem; padding: 12px 32px;">Mua Ngay</a>
            </div>
        </section>

        <!-- Category Section -->
        <section class="category-section" id="san-pham">
            <div class="container">
                <h2 class="section-title">Danh Mục Sản Phẩm</h2>
                <div class="category-grid">
                    <a href="{{ route('products.sweet-bread') }}" class="text-decoration-none">
                        <div class="category-card">
                            <div class="category-icon">🍰</div>
                            <div class="category-name">Bánh Ngọt</div>
                        </div>
                    </a>
                    <a href="{{ route('products.salty-bread') }}" class="text-decoration-none">
                        <div class="category-card">
                            <div class="category-icon">🥐</div>
                            <div class="category-name">Bánh Mặn</div>
                        </div>
                    </a>
                    <a href="{{ route('products.new') }}" class="text-decoration-none">
                        <div class="category-card">
                            <div class="category-icon">⭐</div>
                            <div class="category-name">Sản Phẩm Mới</div>
                        </div>
                    </a>
                    <a href="{{ route('products.hot-selling') }}" class="text-decoration-none">
                        <div class="category-card">
                            <div class="category-icon">🏆</div>
                            <div class="category-name">Bán Chạy Nhất</div>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <!-- Price Filter Section -->
        <section style="background: white; padding: 40px 20px; border-top: 1px solid #e0e0e0;">
            <div class="container">
                <h3 style="color: var(--bm-dark); font-weight: 700; margin-bottom: 25px; font-size: 1.3rem;">Lọc theo Giá</h3>
                <div class="row g-4">
                    <div class="col-lg-2 col-md-3 col-sm-6">
                        <div style="background: #f9f9f9; border-radius: 8px; padding: 15px; border: 1px solid #eee;">
                            <label style="display: flex; align-items: center; cursor: pointer; margin-bottom: 0;">
                                <input type="checkbox" style="cursor: pointer; width: 18px; height: 18px;" />
                                <span style="margin-left: 8px; color: #333; font-weight: 500;">Dưới 20k</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6">
                        <div style="background: #f9f9f9; border-radius: 8px; padding: 15px; border: 1px solid #eee;">
                            <label style="display: flex; align-items: center; cursor: pointer; margin-bottom: 0;">
                                <input type="checkbox" style="cursor: pointer; width: 18px; height: 18px;" />
                                <span style="margin-left: 8px; color: #333; font-weight: 500;">20k - 30k</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6">
                        <div style="background: #f9f9f9; border-radius: 8px; padding: 15px; border: 1px solid #eee;">
                            <label style="display: flex; align-items: center; cursor: pointer; margin-bottom: 0;">
                                <input type="checkbox" style="cursor: pointer; width: 18px; height: 18px;" />
                                <span style="margin-left: 8px; color: #333; font-weight: 500;">30 - 50k</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6">
                        <div style="background: #f9f9f9; border-radius: 8px; padding: 15px; border: 1px solid #eee;">
                            <label style="display: flex; align-items: center; cursor: pointer; margin-bottom: 0;">
                                <input type="checkbox" style="cursor: pointer; width: 18px; height: 18px;" />
                                <span style="margin-left: 8px; color: #333; font-weight: 500;">50k - 60k</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6">
                        <div style="background: #f9f9f9; border-radius: 8px; padding: 15px; border: 1px solid #eee;">
                            <label style="display: flex; align-items: center; cursor: pointer; margin-bottom: 0;">
                                <input type="checkbox" style="cursor: pointer; width: 18px; height: 18px;" />
                                <span style="margin-left: 8px; color: #333; font-weight: 500;">Trên 60k</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6">
                        <button style="width: 100%; padding: 10px 15px; background: var(--bm-golden); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(212, 163, 115, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                            Áp dụng
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Products Section -->
        <section style="background: white; padding: 60px 20px;">
            <div class="container">
                <h2 class="section-title">Sản Phẩm Nổi Bật</h2>
                <div class="row g-4">
                    @for($i = 0; $i < 8; $i++)
                    <div class="col-lg-3 col-md-6">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="https://via.placeholder.com/200x200?text=Bánh+Mì" alt="Bánh Mì">
                            </div>
                            <div class="product-body">
                                <div class="product-name">Bánh Mì {{ $i + 1 }}</div>
                                <div class="product-price">{{ number_format(50000 + $i * 5000) }} đ</div>
                                <a href="#" class="btn-primary-modern" style="display: inline-block; font-size: 0.9rem; padding: 8px 16px;">Xem Chi Tiết</a>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </section>

        <!-- News & Promotions Section -->
        <section style="background: #f5f2ed; padding: 60px 20px;" id="tin-tuc">
            <div class="container">
                <h2 class="section-title">Tin Tức & Khuyến Mãi</h2>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6">
                        <div class="news-card">
                            <div class="news-image">📰</div>
                            <div class="news-content">
                                <div class="news-title">Bánh Mì Đặc Biệt Tháng 2</div>
                                <div class="news-desc">Khuyến mãi đặc biệt cho các loại bánh mì mới - giảm giá tới 30% cho khách hàng thân thiết.</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="news-card">
                            <div class="news-image">🎉</div>
                            <div class="news-content">
                                <div class="news-title">Chương Trình Mua Hàng</div>
                                <div class="news-desc">Mua 3 chiếc bánh, tặng 1 chiếc bánh miễn phí. Không giới hạn số lượng, áp dụng tất cả sản phẩm.</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="news-card">
                            <div class="news-image">🎁</div>
                            <div class="news-content">
                                <div class="news-title">Giao Hàng Miễn Phí</div>
                                <div class="news-desc">Giao hàng miễn phí cho đơn hàng từ 200,000 đ. Giao hàng nhanh chóng, an toàn và đúng hạn.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action -->
        <section style="background: var(--bm-golden); color: white; padding: 60px 20px; text-align: center;">
            <div class="container">
                <h2 style="font-size: 2.5rem; margin-bottom: 20px;">Sẵn Sàng Thưởng Thức?</h2>
                <p style="font-size: 1.2rem; margin-bottom: 30px;">Đặt hàng ngay hôm nay và nhận những chiếc bánh tươi ngon nhất</p>
                <a href="#san-pham" class="btn-secondary-modern" style="font-size: 1.1rem; padding: 12px 32px;">Xem Tất Cả Sản Phẩm</a>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 mb-4">
                        <h5>Bánh Mì Shop</h5>
                        <p>Cung cấp bánh mì tươi ngon, chất lượng cao với nhiều lựa chọn hương vị đa dạng.</p>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <h5>Liên Kết Nhanh</h5>
                        <ul style="list-style: none; padding: 0;">
                            <li><a href="#" style="color: #bbb;">Trang Chủ</a></li>
                            <li><a href="#" style="color: #bbb;">Sản Phẩm</a></li>
                            <li><a href="#" style="color: #bbb;">Giỏ Hàng</a></li>
                            <li><a href="#" style="color: #bbb;">Liên Hệ</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <h5>Thông Tin</h5>
                        <ul style="list-style: none; padding: 0;">
                            <li><a href="#" style="color: #bbb;">Về Chúng Tôi</a></li>
                            <li><a href="#" style="color: #bbb;">Chính Sách</a></li>
                            <li><a href="#" style="color: #bbb;">Điều Khoản</a></li>
                            <li><a href="#" style="color: #bbb;">FAQ</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <h5>Liên Hệ Chúng Tôi</h5>
                        <p>📞 (84) 123-456-789<br>
                           📧 hello@banhmishop.com<br>
                           📍 123 Đường Bánh Mì, TP.HCM</p>
                    </div>
                </div>
                <hr style="border-color: #555;">
                <div style="text-align: center; color: #aaa;">
                    <p>&copy; 2026 Bánh Mì Shop. All Rights Reserved.</p>
                </div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
