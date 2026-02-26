<x-app-layout>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Quản Lý Bánh Mì</h1>
            <a href="{{ route('admin.breads.create') }}" class="btn btn-primary">➕ Thêm mới</a>
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
                                <th>Tên</th>
                                <th>Giá</th>
                                <th>Tồn kho</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($breads as $bread)
                            <tr>
                                <td>{{ $bread->id }}</td>
                                <td>
                                    @if($bread->image_url)
                                    <img src="{{ $bread->image_url }}" width="50" class="rounded">
                                    @else
                                    <span class="text-muted">Không có ảnh</span>
                                    @endif
                                </td>
                                <td>{{ $bread->name }}</td>
                                <td>{{ number_format($bread->price) }} đ</td>
                                <td>{{ $bread->stock }}</td>
                                <td>
                                    @if($bread->is_available)
                                    <span class="badge bg-success">Còn bán</span>
                                    @else
                                    <span class="badge bg-secondary">Ngừng bán</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.breads.edit', $bread->id) }}"
                                        class="btn btn-sm btn-warning">Sửa</a>

                                    <form action="{{ route('admin.breads.destroy', $bread->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Xóa bánh mì này?')">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $breads->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>