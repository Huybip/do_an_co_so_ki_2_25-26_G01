<x-app-layout>
    <div class="container py-5">
        <h1 class="mb-4">Lịch Sử Đơn Hàng</h1>

        @if($orders->isEmpty())
        <div class="alert alert-info">
            Bạn chưa có đơn hàng nào. <a href="{{ route('home') }}">Mua sắm ngay</a>
        </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Mã đơn</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
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
                        <td>
                            <a href="{{ route('order.detail', $order->id) }}" class="btn btn-sm btn-outline-primary">Chi tiết</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</x-app-layout>