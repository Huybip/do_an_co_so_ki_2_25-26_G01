<x-app-layout>
    <div class="container py-5">
        <h1 class="mb-4">Quản Lý Đơn Hàng</h1>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Mã</th>
                                <th>Khách hàng</th>
                                <th>Điện thoại</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Ngày đặt</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ $order->customer_phone }}</td>
                                <td class="text-danger fw-bold">{{ number_format($order->total_amount) }} đ</td>
                                <td>
                                    @switch($order->status)
                                    @case('pending')
                                    <span class="badge bg-warning">Chờ xử lý</span>
                                    @break
                                    @case('processing')
                                    <span class="badge bg-info">Đang xử lý</span>
                                    @break
                                    @case('shipping')
                                    <span class="badge bg-primary">Đang giao</span>
                                    @break
                                    @case('completed')
                                    <span class="badge bg-success">Hoàn thành</span>
                                    @break
                                    @case('cancelled')
                                    <span class="badge bg-danger">Đã hủy</span>
                                    @break
                                    @endswitch
                                </td>
                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                        class="btn btn-sm btn-outline-primary">Chi tiết</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>