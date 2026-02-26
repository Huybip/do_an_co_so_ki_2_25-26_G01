<x-app-layout>
    <div style="background: linear-gradient(135deg, var(--bm-cream) 0%, #F5F2ED 100%); padding: 40px 0;">
        <div class="container">
            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb small mb-0" style="background: transparent;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: var(--bm-golden);">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="color: var(--bm-dark)">Sản phẩm mới</li>
                </ol>
            </nav>

            {{-- Header Section --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h1 class="h2 mb-2" style="color: var(--bm-dark); font-weight: 700;">⭐ Sản phẩm mới nhất</h1>
                    <p style="color: #666; margin: 0;">Những sản phẩm mới được bổ sung gần đây</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            {{-- Products Section --}}
            <div class="col-12">
                @if($breads->count() > 0)
                    <div class="row g-4" id="breads">
                        @foreach($breads as $bread)
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="product-card" style="background: white; border-radius: 12px; overflow: hidden; border: 1px solid #eee; height: 100%; display: flex; flex-direction: column; position: relative;">
                                    {{-- New Badge --}}
                                    <div style="position: absolute; top: 15px; right: 15px; background: var(--bm-golden); color: white; padding: 5px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 700; z-index: 10;">
                                        Mới
                                    </div>

                                    @if($bread->image_url)
                                        <img src="{{ $bread->image_url }}" class="card-img-top" alt="{{ $bread->name }}" style="height: 200px; object-fit: contain; background: #f5f2ed; padding: 10px;">
                                    @else
                                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px; background: #f5f2ed;">
                                            <span style="color: #999;">Không có ảnh</span>
                                        </div>
                                    @endif

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
                            Hiện tại chưa có sản phẩm mới nào.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
