<x-app-layout>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Quản Lý Mã Giảm Giá</h1>
            <a href="{{ route('admin.promo-codes.create') }}" class="btn btn-primary">
                + Thêm Mã Giảm Giá
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Mã</th>
                            <th>Loại Giảm</th>
                            <th>Giá Trị</th>
                            <th>Sử Dụng</th>
                            <th>Hết Hạn</th>
                            <th>Trạng Thái</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($promoCodes as $promo)
                        <tr>
                            <td>
                                <strong>{{ $promo->code }}</strong>
                                @if($promo->description)
                                <br><small class="text-muted">{{ $promo->description }}</small>
                                @endif
                            </td>
                            <td>
                                @if($promo->discount_type === 'percentage')
                                    <span class="badge bg-info">Phần Trăm</span>
                                @else
                                    <span class="badge bg-success">Cố Định</span>
                                @endif
                            </td>
                            <td>
                                @if($promo->discount_type === 'percentage')
                                    {{ $promo->discount_value }}%
                                @else
                                    {{ number_format($promo->discount_value) }}đ
                                @endif
                            </td>
                            <td>
                                {{ $promo->used_count }}
                                @if($promo->max_usage)
                                    / {{ $promo->max_usage }}
                                @else
                                    / Không giới hạn
                                @endif
                            </td>
                            <td>
                                @if($promo->expires_at)
                                    {{ $promo->expires_at->format('d/m/Y') }}
                                    @if($promo->expires_at < now())
                                        <small class="text-danger">(Hết hạn)</small>
                                    @endif
                                @else
                                    <span class="text-muted">Không giới hạn</span>
                                @endif
                            </td>
                            <td>
                                @if($promo->is_active)
                                    <span class="badge bg-success">Hoạt động</span>
                                @else
                                    <span class="badge bg-secondary">Không hoạt động</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.promo-codes.edit', $promo->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                                <form action="{{ route('admin.promo-codes.destroy', $promo->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Xóa mã này?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                Không có mã giảm giá nào. <a href="{{ route('admin.promo-codes.create') }}">Tạo mới</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $promoCodes->links() }}
        </div>
    </div>
</x-app-layout>
