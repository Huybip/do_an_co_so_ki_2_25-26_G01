<x-app-layout>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Quản Lý Tin Tức & Khuyến Mãi</h1>
            <a href="{{ route('admin.news.create') }}" class="btn btn-primary">➕ Thêm mới</a>
        </div>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ảnh</th>
                                <th>Tiêu đề</th>
                                <th>Trạng thái</th>
                                <th>Ngày đăng</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($news as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" width="80" class="rounded">
                                    @else
                                    <span class="text-muted">Không có</span>
                                    @endif
                                </td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    @if($item->is_published)
                                    <span class="badge bg-success">Đã đăng</span>
                                    @else
                                    <span class="badge bg-secondary">Bản nháp</span>
                                    @endif
                                </td>
                                <td>{{ $item->published_at ? $item->published_at->format('Y-m-d') : '-' }}</td>
                                <td>
                                    <a href="{{ route('news.show', $item->slug) }}" class="btn btn-sm btn-info" target="_blank">Xem</a>
                                    <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-sm btn-warning">Sửa</a>

                                    <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Xóa tin tức này?')">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $news->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
