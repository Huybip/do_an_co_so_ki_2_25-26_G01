<x-app-layout>
    <div class="container py-5">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb small mb-0" style="background: transparent;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: var(--bm-golden);">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('news.index') }}" style="color: var(--bm-golden);">Tin tức</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color: var(--bm-dark)">{{ $item->title }}</li>
            </ol>
        </nav>

        <div style="background: white; border-radius: 12px; padding: 24px; border: 1px solid #eee;">
            <h1 style="margin-top:0; color:var(--bm-dark);">{{ $item->title }}</h1>
            @if($item->image)
                <img src="{{ $item->image }}" alt="{{ $item->title }}" style="width:100%; max-height:420px; object-fit:cover; border-radius:8px; margin:12px 0;">
            @endif
            <p style="color:#666;">{!! nl2br(e($item->content)) !!}</p>
        </div>
    </div>
</x-app-layout>
