<x-app-layout>
    <div class="container py-5">
        <h1 class="mb-4" style="color: var(--bm-dark);">Tin tức & Khuyến mãi</h1>

        <div class="row g-4">
            @foreach($news as $item)
            <div class="col-lg-4 col-md-6">
                <div style="background: white; border-radius: 12px; padding: 18px; border: 1px solid #eee; height:100%; display:flex; flex-direction:column;">
                    @if($item->image)
                        <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" style="width:100%; height:160px; object-fit:cover; border-radius:8px; margin-bottom:12px;">
                    @endif
                    <h5 style="margin:0 0 8px 0; color:var(--bm-dark); font-weight:700;">{{ $item->title }}</h5>
                    <p style="color:#666; flex:1;">{{ $item->excerpt }}</p>
                    <a href="{{ route('news.show', $item->slug) }}" class="btn btn-outline-secondary mt-3" style="border-color:var(--bm-golden); color:var(--bm-golden);">Xem chi tiết</a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-4">{{ $news->links() }}</div>
    </div>
</x-app-layout>
