<x-app-layout>
    <div style="background: linear-gradient(135deg, var(--bm-cream) 0%, #F5F2ED 100%); padding: 40px 0;">
        <div class="container">
            {{-- Header Section --}}
            <div class="text-center mb-4">
                <h1 class="h2 mb-2" style="color: var(--bm-dark); font-weight: 700;">🖼️ Bộ sưu tập bánh</h1>
                <p style="color: #666; margin: 0;">Khám phá toàn bộ những chiếc bánh tinh tế và tuyệt vời của chúng tôi</p>
            </div>
        </div>
    </div>

    <div class="container py-5">
        {{-- Gallery Grid --}}
        <div class="row g-4" id="galleryGrid">
            @forelse($breads as $bread)
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="gallery-item position-relative overflow-hidden" style="background: white; border-radius: 12px; cursor: pointer; transition: all 0.3s; border: 1px solid #eee; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); position: relative;"
                        onmouseover="this.style.boxShadow='0 8px 24px rgba(212, 163, 115, 0.3)'; this.style.transform='translateY(-5px)'" 
                        onmouseout="this.style.boxShadow='0 2px 8px rgba(0, 0, 0, 0.1)'; this.style.transform='translateY(0)'"
                        data-bs-toggle="modal" data-bs-target="#galleryModal" data-id="{{ $bread->id }}" data-name="{{ $bread->name }}" data-price="{{ $bread->price }}" data-description="{{ $bread->description }}" data-image="{{ $bread->image_url }}" data-type="{{ $bread->type }}">
                        
                        {{-- Image Container --}}
                        @if($bread->image_url)
                            <img src="{{ $bread->image_url }}" alt="{{ $bread->name }}" style="width: 100%; height: 200px; object-fit: contain; background: #f5f2ed; padding: 15px;">
                        @else
                            <div style="width: 100%; height: 200px; background: #f5f2ed; display: flex; align-items: center; justify-content: center;">
                                <span style="color: #999;">Không có ảnh</span>
                            </div>
                        @endif

                        {{-- Overlay --}}
                        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(212, 163, 115, 0.9); opacity: 0; transition: all 0.3s; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 1.1rem;" class="gallery-overlay">
                            👁️ Xem chi tiết
                        </div>

                        {{-- Info Section --}}
                        <div style="padding: 15px;">
                            <h6 class="mb-2" style="color: var(--bm-dark); font-weight: 600; font-size: 0.95rem; min-height: 2.4em; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">{{ $bread->name }}</h6>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <p style="color: var(--bm-coral); font-weight: 700; margin: 0; font-size: 1.1rem;">{{ number_format($bread->price) }} đ</p>
                                <span style="background: {{ $bread->type == 'sweet' ? '#FFE5D9' : '#E8F0E8' }}; color: {{ $bread->type == 'sweet' ? '#D97706' : '#059669' }}; padding: 4px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 600;">
                                    {{ $bread->type == 'sweet' ? '🍰 Ngọt' : '🥐 Mặn' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p style="color: #999; font-size: 1.1rem;">Chưa có sản phẩm nào</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($breads->hasPages())
            <nav aria-label="Page navigation" class="mt-5">
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
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($breads->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $breads->nextPageUrl() }}">Tiếp →</a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link">Tiếp →</span></li>
                    @endif
                </ul>
            </nav>
        @endif
    </div>

    {{-- Gallery Modal --}}
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border: 1px solid #eee; border-radius: 12px;">
                <div class="modal-header" style="border-bottom: 1px solid #eee;">
                    <h5 class="modal-title" id="galleryModalLabel" style="color: var(--bm-dark); font-weight: 700;"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{-- Image Section --}}
                        <div class="col-md-6">
                            <img id="modalImage" src="" alt="" style="width: 100%; height: auto; border-radius: 8px; object-fit: contain;">
                        </div>
                        {{-- Info Section --}}
                        <div class="col-md-6">
                            <div style="padding: 20px;">
                                <h4 id="modalName" style="color: var(--bm-dark); font-weight: 700; margin-bottom: 10px;"></h4>
                                
                                <div style="margin-bottom: 15px;">
                                    <span id="modalType" style="background: #FFE5D9; color: #D97706; padding: 6px 12px; border-radius: 6px; font-weight: 600; font-size: 0.9rem;"></span>
                                </div>

                                <p id="modalDescription" style="color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 20px;"></p>

                                <div style="background: #f5f2ed; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                                    <p style="margin: 0; color: #999; font-size: 0.85rem; margin-bottom: 5px;">Giá</p>
                                    <p id="modalPrice" style="margin: 0; color: var(--bm-coral); font-weight: 700; font-size: 1.8rem;"></p>
                                </div>

                                <div style="display: flex; gap: 10px;">
                                    <form id="addToCartForm" method="POST" style="flex: 1;">
                                        @csrf
                                        <button type="submit" class="w-100" style="padding: 12px 20px; background: var(--bm-golden); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.3s; font-size: 1rem;"
                                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(212, 163, 115, 0.3)'"
                                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                            🛒 Thêm vào giỏ
                                        </button>
                                    </form>
                                    <a id="detailLink" href="#" style="padding: 12px 20px; border: 1px solid var(--bm-golden); color: var(--bm-golden); border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.3s; text-decoration: none; display: flex; align-items: center; justify-content: center;"
                                        onmouseover="this.style.background='var(--bm-golden)'; this.style.color='white'"
                                        onmouseout="this.style.background='transparent'; this.style.color='var(--bm-golden)'">
                                        📄 Chi tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .gallery-item:hover .gallery-overlay {
            opacity: 1 !important;
        }

        .pagination .page-link {
            color: var(--bm-golden);
            border-color: var(--bm-golden);
            transition: all 0.3s;
        }

        .pagination .page-link:hover {
            background: var(--bm-golden);
            color: white;
        }

        .pagination .page-item.active .page-link {
            background: var(--bm-golden);
            border-color: var(--bm-golden);
        }
    </style>

    <script>
        document.querySelectorAll('.gallery-item').forEach(item => {
            item.addEventListener('click', function() {
                const id = this.dataset.id;
                const name = this.dataset.name;
                const price = this.dataset.price;
                const description = this.dataset.description;
                const image = this.dataset.image;
                const type = this.dataset.type;

                document.getElementById('galleryModalLabel').textContent = name;
                document.getElementById('modalName').textContent = name;
                document.getElementById('modalImage').src = image || 'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22400%22%3E%3Crect fill=%22%23f5f2ed%22 width=%22400%22 height=%22400%22/%3E%3C/svg%3E';
                document.getElementById('modalPrice').textContent = new Intl.NumberFormat('vi-VN').format(price) + ' đ';
                document.getElementById('modalDescription').textContent = description || 'Sản phẩm chất lượng từ tiệm bánh của chúng tôi';
                document.getElementById('modalType').textContent = type === 'sweet' ? '🍰 Bánh ngọt' : '🥐 Bánh mặn';
                document.getElementById('modalType').style.background = type === 'sweet' ? '#FFE5D9' : '#E8F0E8';
                document.getElementById('modalType').style.color = type === 'sweet' ? '#D97706' : '#059669';
                
                document.getElementById('addToCartForm').action = `/cart/add/${id}`;
                document.getElementById('detailLink').href = `/bread/${id}`;
            });
        });
    </script>
</x-app-layout>
