<x-app-layout>
    <div class="container py-5">
        <div class="text-center">
            <div class="mb-4">
                <span class="text-success" style="font-size: 80px;">✓</span>
            </div>
            <h1 class="text-success">Đặt hàng thành công!</h1>
            <p class="lead">Cảm ơn bạn đã đặt hàng. Mã đơn hàng: <strong>#{{ $order->id }}</strong></p>

            <div class="card mx-auto" style="max-width: 600px;">
                <div class="card-body">
                    <h5>Thông tin đơn hàng</h5>
                    <p><strong>Người nhận:</strong> {{ $order->customer_name }}</p>
                    <p><strong>Điện thoại:</strong> {{ $order->customer_phone }}</p>
                    <p><strong>Địa chỉ:</strong> {{ $order->customer_address }}</p>
                    <p><strong>Tổng tiền:</strong> <span class="text-danger">{{ number_format($order->total_amount) }} đ</span></p>
                    <p><strong>Trạng thái:</strong> <span class="badge bg-warning">Chờ xử lý</span></p>
                    <p class="text-muted small">💰 Thanh toán khi nhận hàng (COD)</p>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('home') }}" class="btn btn-primary">Tiếp tục mua sắm</a>
                <a href="{{ route('order.history') }}" class="btn btn-outline-secondary">Xem đơn hàng</a>
            </div>
        </div>
    </div>
</x-app-layout>