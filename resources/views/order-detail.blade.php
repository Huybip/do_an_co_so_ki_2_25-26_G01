<x-app-layout>
    <div class="container py-5">
        <h1 class="mb-4">Chi Tiết Đơn Hàng #{{ $order->id }}</h1>

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Sản phẩm</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tên sản phẩm</th>
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
                                        <td class="fw-bold">{{ number_format($item->price * $item->quantity) }} đ</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>Tiền hàng:</strong></td>
                                        <td class="text-dark fw-bold">
                                            {{ number_format($order->total_amount + $order->discount_amount) }} đ
                                        </td>
                                    </tr>
                                    @if($order->discount_amount > 0)
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>Giảm giá:</strong></td>
                                        <td class="text-danger fw-bold">
                                            -{{ number_format($order->discount_amount) }} đ
                                            @if($order->promoCode)
                                            <small class="badge bg-success">{{ $order->promoCode->code }}</small>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>Tổng thanh toán:</strong></td>
                                        <td class="text-danger fs-5 fw-bold">{{ number_format($order->total_amount) }} đ</td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>Tổng thanh toán:</strong></td>
                                        <td class="text-danger fs-5 fw-bold">{{ number_format($order->total_amount) }} đ</td>
                                    </tr>
                                    @endif
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Thông tin giao hàng</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Người nhận:</strong> {{ $order->customer_name }}</p>
                        <p><strong>Điện thoại:</strong> {{ $order->customer_phone }}</p>
                        <p><strong>Địa chỉ:</strong> {{ $order->customer_address }}</p>
                        @if($order->note)
                        <p><strong>Ghi chú:</strong> {{ $order->note }}</p>
                        @endif
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5>Trạng thái đơn hàng</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Trạng thái:</strong>
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
                        </p>
                        <p class="text-muted small">💰 Thanh toán khi nhận hàng (COD)</p>
                    </div>
                </div>

                <a href="{{ route('order.history') }}" class="btn btn-outline-secondary mt-3 w-100">← Quay lại</a>
            </div>
        </div>
    </div>
</x-app-layout>