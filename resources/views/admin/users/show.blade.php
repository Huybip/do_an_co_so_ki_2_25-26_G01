<x-app-layout>
    <div class="container py-5">
        <div class="mb-4">
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">← Quay lại</a>
            <h1 class="mt-3">Chi Tiết Người Dùng</h1>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Tên</label>
                            <p class="fs-5">{{ $user->name }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">Email</label>
                            <p class="fs-5">{{ $user->email }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">Điện thoại</label>
                            <p class="fs-5">{{ $user->phone ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Vai trò</label>
                            <p>
                                @if($user->role === 'admin')
                                <span class="badge bg-danger">Admin</span>
                                @else
                                <span class="badge bg-primary">Khách hàng</span>
                                @endif
                            </p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">Ngày tạo</label>
                            <p class="fs-5">{{ $user->created_at->format('d/m/Y H:i') }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">Cập nhật cuối</label>
                            <p class="fs-5">{{ $user->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Địa chỉ</label>
                    <p class="fs-5">{{ $user->address ?? '-' }}</p>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Sửa</a>
                    @if(auth()->id() !== $user->id)
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Bạn chắc chắn muốn xóa người dùng này?')">Xóa</button>
                    </form>
                    @endif
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary ms-auto">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
