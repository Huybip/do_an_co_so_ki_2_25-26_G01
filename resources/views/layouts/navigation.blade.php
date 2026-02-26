{{-- Thanh top nhỏ với hotline --}}
<div class="bg-brown text-white py-1">
    <div class="container d-flex justify-content-between align-items-center small">
        <span>BanmyShop - Hotline: <strong>0844825565</strong></span>
        <span>🥖 BanmyShop</span>
    </div>
</div>

{{-- Header chính: Logo | Tìm kiếm | Tài khoản | Giỏ hàng (luôn hiển thị, không nằm trong nút 3 gạch) --}}
<header class="bg-white border-bottom py-3">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center gap-3">
            {{-- Logo --}}
            <a class="navbar-brand fw-bold text-brown mb-0 me-3" href="{{ route('home') }}">
                <img src="{{ asset('images/breads/logo192.png') }}" alt="BanmyShop Logo" class="img-fluid" style="height: 100px;">
            </a>

            {{-- Thanh tìm kiếm (ngay bên cạnh / dưới logo) --}}
            <form action="{{ route('home') }}" method="GET" class="d-flex flex-grow-1 flex-lg-grow-0 flex-xl-grow-1" style="min-width: 200px; max-width: 420px;" role="search">
                <input
                    class="form-control rounded-0 rounded-start"
                    type="search"
                    name="search"
                    placeholder="Tìm kiếm sản phẩm..."
                    aria-label="Search"
                    value="{{ request('search') }}"
                >
                <button class="btn btn-brown text-white rounded-0 rounded-end px-3" type="submit" aria-label="Tìm kiếm">
                    🔍
                </button>
            </form>

            {{-- Tài khoản + Giỏ hàng (luôn bên cạnh) --}}
            <div class="d-flex align-items-center gap-2 ms-auto">
                @guest
                    <a class="btn btn-outline-brown btn-sm text-nowrap" href="{{ route('login') }}">
                        👤 Đăng nhập
                    </a>
                    <a class="btn btn-outline-brown btn-sm  text-nowrap" href="{{ route('register') }}">
                        📝 Đăng ký
                    </a>
                @else
                    <div class="dropdown">
                        <button class="btn btn-outline-brown btn-sm dropdown-toggle text-nowrap" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            👤 {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Tài khoản của tôi</a></li>
                            <li><a class="dropdown-item" href="{{ route('order.history') }}">Đơn hàng</a></li>
                            @if(auth()->user()->isAdmin())
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Quản trị</a></li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Đăng xuất</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endguest

                <a class="btn btn-outline-brown btn-sm position-relative text-nowrap" href="{{ route('cart.index') }}">
                    🛒 Giỏ hàng
                    @if(session('cart') && count(session('cart')) > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>
            </div>
        </div>
    </div>
</header>

{{-- Thanh menu: Trang chủ, Bánh mì, ... (luôn hiển thị, không nằm trong nút 3 gạch) --}}
<div class="bg-light border-bottom">
    <div class="container">
        <div class="d-flex align-items-center justify-content-start gap-4 py-2">
            <a class="text-brown text-decoration-none fw-500" href="{{ route('home') }}">Trang chủ</a>
            
            {{-- Bánh ngọt và Bánh mỳ với dropdown --}}
            <div class="dropdown">
                <a class="text-brown text-decoration-none fw-500 dropdown-toggle" href="#" id="dropdownBanh" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Bánh ngọt và Bánh mỳ
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownBanh">
                    <li><a class="dropdown-item" href="{{ route('home') }}">Tất cả bánh</a></li>
                    <li><a class="dropdown-item" href="{{ route('products.sweet-bread') }}">Bánh ngọt</a></li>
                    <li><a class="dropdown-item" href="{{ route('products.salty-bread') }}">Bánh mặn</a></li>
                </ul>
            </div>
            
            <a class="text-brown text-decoration-none fw-500" href="#">Gallery</a>
            <a class="text-brown text-decoration-none fw-500" href="{{ route('news.index') }}">Tin tức &amp; Khuyến mại</a>
            
            {{-- Liên hệ với dropdown --}}
            <div class="dropdown">
                <a class="text-brown text-decoration-none fw-500 dropdown-toggle" href="#" id="dropdownLienhe" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Liên hệ
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownLienhe">
                    <li><a class="dropdown-item" href="#">Cơ sở 1: Yên Lãng</a></li>
                    <li><a class="dropdown-item" href="#">Cơ sở 2: Hà Đông</a></li>
                    <li><a class="dropdown-item" href="#">Cơ sở 3: Trung tâm thương mại Aeon Mall</a></li>
                </ul>
            </div>
            
            <a class="text-brown text-decoration-none fw-500" href="#">More...</a>
        </div>
    </div>
</div>
