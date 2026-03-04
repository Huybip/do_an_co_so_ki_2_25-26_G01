<x-app-layout>
    <div style="background: linear-gradient(135deg, var(--bm-cream) 0%, #F5F2ED 100%); padding: 40px 0;">
        <div class="container">
            {{-- Breadcrumb --}}
            

            {{-- Header Section --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h1 class="h2 mb-2" style="color: var(--bm-dark); font-weight: 700;">Tất cả sản phẩm</h1>
                    <p style="color: #666; margin: 0;">{{ $breads->total() }} sản phẩm</p>
                </div>
                <button class="btn btn-outline-secondary d-lg-none" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#categorySidebar" aria-controls="categorySidebar" style="color: var(--bm-golden); border-color: var(--bm-golden);">
                    ☰ Danh mục
                </button>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            {{-- Sidebar --}}
            <div class="col-lg-3 d-none d-lg-block">
                <div style="background: white; border-radius: 12px; padding: 20px; border: 1px solid #eee; margin-bottom: 20px;">
                    <h5 style="color: var(--bm-dark); font-weight: 700; margin-bottom: 20px;">Danh mục sản phẩm</h5>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="margin-bottom: 12px;">
                            <a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--bm-golden); font-weight: 600; transition: all 0.3s;">Tất cả sản phẩm</a>
                        </li>
                        <li style="margin-bottom: 12px;">
                            <a href="{{ route('products.new') }}" class="text-decoration-none" style="color: #666; font-weight: 600; transition: all 0.3s;">Sản phẩm mới</a>
                        </li>
                        <li style="margin-bottom: 12px;">
                            <a href="{{ route('products.hot-selling') }}" class="text-decoration-none" style="color: #666; font-weight: 600; transition: all 0.3s;">Sản phẩm bán chạy</a>
                        </li>
                        <li style="margin-bottom: 12px;">
                            <a href="{{ route('products.sweet-bread') }}" class="text-decoration-none" style="color: #666; font-weight: 600; transition: all 0.3s;">Bánh ngọt</a>
                        </li>
                        <li style="margin-bottom: 12px;">
                            <a href="{{ route('products.salty-bread') }}" class="text-decoration-none" style="color: #666; font-weight: 600; transition: all 0.3s;">Bánh mặn</a>
                        </li>
                    </ul>
                </div>

                {{-- Price Filter --}}
                <div style="background: white; border-radius: 12px; padding: 20px; border: 1px solid #eee;">
                    <h5 style="color: var(--bm-dark); font-weight: 700; margin-bottom: 20px;">Lọc theo giá</h5>
                    <form id="priceFilterForm" method="GET" action="{{ route('home') }}" style="display: flex; flex-direction: column; gap: 12px;">
                        <label style="display: flex; align-items: center; cursor: pointer;">
                            <input type="checkbox" name="price[]" value="0-20000" style="cursor: pointer; width: 16px; height: 16px;" {{ (request('price') && in_array('0-20000', (array) request('price'))) ? 'checked' : '' }} />
                            <span style="margin-left: 8px; color: #666; font-weight: 500;">Dưới 20,000 đ</span>
                        </label>
                        <label style="display: flex; align-items: center; cursor: pointer;">
                            <input type="checkbox" name="price[]" value="20000-30000" style="cursor: pointer; width: 16px; height: 16px;" {{ (request('price') && in_array('20000-30000', (array) request('price'))) ? 'checked' : '' }} />
                            <span style="margin-left: 8px; color: #666; font-weight: 500;">20,000 - 30,000 đ</span>
                        </label>
                        <label style="display: flex; align-items: center; cursor: pointer;">
                            <input type="checkbox" name="price[]" value="30000-50000" style="cursor: pointer; width: 16px; height: 16px;" {{ (request('price') && in_array('30000-50000', (array) request('price'))) ? 'checked' : '' }} />
                            <span style="margin-left: 8px; color: #666; font-weight: 500;">30,000 - 50,000 đ</span>
                        </label>
                        <label style="display: flex; align-items: center; cursor: pointer;">
                            <input type="checkbox" name="price[]" value="50000-60000" style="cursor: pointer; width: 16px; height: 16px;" {{ (request('price') && in_array('50000-60000', (array) request('price'))) ? 'checked' : '' }} />
                            <span style="margin-left: 8px; color: #666; font-weight: 500;">50,000 - 60,000 đ</span>
                        </label>
                        <label style="display: flex; align-items: center; cursor: pointer;">
                            <input type="checkbox" name="price[]" value="60000" style="cursor: pointer; width: 16px; height: 16px;" {{ (request('price') && in_array('60000', (array) request('price'))) ? 'checked' : '' }} />
                            <span style="margin-left: 8px; color: #666; font-weight: 500;">Trên 60,000 đ</span>
                        </label>
                        <button type="submit" id="applyFilterBtn" style="width: 100%; margin-top: 12px; padding: 10px 15px; background: var(--bm-golden); color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; transition: all 0.3s;" 
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(212, 163, 115, 0.3)'" 
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                            Áp dụng
                        </button>
                    </form>
                </div>
            </div>

            {{-- Offcanvas for Mobile --}}
            <div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="categorySidebar" aria-labelledby="categorySidebarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="categorySidebarLabel">Danh mục sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="margin-bottom: 12px;">
                            <a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--bm-golden); font-weight: 600;">Tất cả sản phẩm</a>
                        </li>
                        <li style="margin-bottom: 12px;">
                            <a href="{{ route('products.new') }}" class="text-decoration-none" style="color: #666; font-weight: 600;">Sản phẩm mới</a>
                        </li>
                        <li style="margin-bottom: 12px;">
                            <a href="{{ route('products.hot-selling') }}" class="text-decoration-none" style="color: #666; font-weight: 600;">Sản phẩm bán chạy</a>
                        </li>
                        <li style="margin-bottom: 12px;">
                            <a href="{{ route('products.sweet-bread') }}" class="text-decoration-none" style="color: #666; font-weight: 600;">Bánh ngọt</a>
                        </li>
                        <li style="margin-bottom: 12px;">
                            <a href="{{ route('products.salty-bread') }}" class="text-decoration-none" style="color: #666; font-weight: 600;">Bánh mặn</a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Products Section --}}
            <div class="col-lg-9">
                @if($breads->count() > 0)
                    <div class="row g-4" id="breads">
                        @foreach($breads as $bread)
                            <div class="col-md-6 col-lg-4 mb-3" onmouseover="this.querySelector('.product-overlay').style.opacity='1'" onmouseout="this.querySelector('.product-overlay').style.opacity='0'">
                                <div class="product-card" style="background: white; border-radius: 12px; overflow: hidden; border: 1px solid #eee; height: 100%; display: flex; flex-direction: column;">
                                    <div style="position: relative; width: 100%; height: 200px;">
                                        @if($bread->image_url)
                                            <img src="{{ $bread->image_url }}" class="card-img-top" alt="{{ $bread->name }}" style="height: 100%; width: 100%; object-fit: contain; background: #f5f2ed; padding: 10px;">
                                        @else
                                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 100%; width: 100%; background: #f5f2ed;">
                                                <span style="color: #999;">Không có ảnh</span>
                                            </div>
                                        @endif
                                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(212, 163, 115, 0.85); opacity: 0; transition: all 0.3s; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 0.9rem; width: 70%; height: 70%; border-radius: 16px; pointer-events: none;" class="product-overlay">
                                            👁️ Xem chi tiết
                                        </div>
                                    </div>

                                    <div style="flex: 1; padding: 20px; display: flex; flex-direction: column;">
                                        <h6 class="card-title mb-2" style="color: var(--bm-dark); font-weight: 600; font-size: 1.05rem;">{{ $bread->name }}</h6>
                                        <p class="mb-2" style="color: var(--bm-coral); font-weight: 700; font-size: 1.2rem;">{{ number_format($bread->price) }} đ</p>
                                        
                                        <div style="margin-top: auto; display: flex; gap: 10px;">
                                            <a href="{{ route('bread.show', $bread->id) }}" class="flex-grow-1" style="display: inline-block; padding: 8px 12px; border-radius: 6px; text-align: center; text-decoration: none; border: 1px solid var(--bm-golden); color: var(--bm-golden); font-weight: 600; transition: all 0.3s;">Chi tiết</a>

                                            @if($bread->stock > 0)
                                                <form action="{{ route('cart.add', $bread->id) }}" method="POST" style="flex-grow: 1;">
                                                    @csrf
                                                    <button type="submit" class="w-100 btn-brown" style="border: none; padding: 8px 12px; border-radius: 6px; background: var(--bm-golden); color: white; font-weight: 600; cursor: pointer; transition: all 0.3s;">Thêm vào giỏ</button>
                                                </form>
                                            @else
                                                <button class="flex-grow-1" style="padding: 8px 12px; border-radius: 6px; border: 1px solid #ccc; background: #eee; color: #999; font-weight: 600; cursor: not-allowed;">Hết hàng</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-5">
                        @if($breads->hasPages())
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    {{-- Previous Page Link --}}
                                    @if ($breads->onFirstPage())
                                        <li class="page-item disabled"><span class="page-link">← Trước</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $breads->previousPageUrl() }}">← Trước</a></li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach ($breads->getUrlRange(1, $breads->lastPage()) as $page => $url)
                                        @if ($page == $breads->currentPage())
                                            <li class="page-item active"><span class="page-link" style="background: var(--bm-golden); border-color: var(--bm-golden);">{{ $page }}</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if ($breads->hasMorePages())
                                        <li class="page-item"><a class="page-link" href="{{ $breads->nextPageUrl() }}">Sau →</a></li>
                                    @else
                                        <li class="page-item disabled"><span class="page-link">Sau →</span></li>
                                    @endif
                                </ul>
                            </nav>
                        @endif
                    </div>
                @else
                    <div style="background: white; border-radius: 12px; padding: 60px 20px; text-align: center; border: 1px solid #eee;">
                        <h5 style="color: var(--bm-dark); margin-bottom: 10px;">Không tìm thấy sản phẩm</h5>
                        <p style="color: #666; margin: 0;">
                            Hiện tại chưa có bánh mì nào trong cửa hàng. Vui lòng quay lại sau!
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>