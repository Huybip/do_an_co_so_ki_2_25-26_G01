<x-app-layout>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6">
                @if($bread->image_url)
                <img src="{{ $bread->image_url }}" class="img-fluid rounded" alt="{{ $bread->name }}">
                @else
                <div class="bg-secondary d-flex align-items-center justify-content-center rounded" style="height: 400px;">
                    <span class="text-white fs-4">Không có ảnh</span>
                </div>
                @endif
            </div>

            <div class="col-md-6">
                <h1>{{ $bread->name }}</h1>
                <p class="text-danger fs-3 fw-bold">{{ number_format($bread->price) }} đ</p>
                <p class="text-muted">Còn lại: {{ $bread->stock }}</p>

                <hr>

                <h5>Mô tả:</h5>
                <p>{{ $bread->description ?? 'Chưa có mô tả' }}</p>

                <hr>

                @if($bread->stock > 0)
                <form action="{{ route('cart.add', $bread->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg">
                        🛒 Thêm vào giỏ hàng
                    </button>
                </form>
                @else
                <button class="btn btn-secondary btn-lg" disabled>Hết hàng</button>
                @endif

                <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg mt-2">← Quay lại</a>
            </div>
        </div>
    </div>
</x-app-layout>