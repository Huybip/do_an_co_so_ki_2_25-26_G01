<x-app-layout>
    <div class="container py-5">
        <h1 class="mb-4">Chi Tiết Đơn Hàng #{{ $order->id }}</h1>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Sản phẩm</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                <tr>
                                    <td>{{ $item->bread->name ?? 'Đã xóa' }}</td>
                                    <td>{{ number_format($item->price) }} đ</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->price * $item->quantity) }} đ</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                                    <td class="text-danger fs-5 fw-bold">{{ number_format($order->total_amount) }} đ</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Thông tin khách hàng</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Tên:</strong> {{ $order->customer_name }}</p>
                        <p><strong>SĐT:</strong> {{ $order->customer_phone }}</p>
                        <p><strong>Địa chỉ:</strong> {{ $order->customer_address }}</p>
                        @if($order->note)
                        <p><strong>Ghi chú:</strong> {{ $order->note }}</p>
                        @endif
                        <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5>Cập nhật trạng thái</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <select name="status" class="form-select mb-3">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                                <option value="shipping" {{ $order->status == 'shipping' ? 'selected' : '' }}>Đang giao</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                            </select>

                            <button type="submit" class="btn btn-primary w-100">Cập nhật</button>
                        </form>
                    </div>
                </div>

                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary mt-3 w-100">← Quay lại</a>
            </div>
        </div>
    </div>
</x-app-layout>