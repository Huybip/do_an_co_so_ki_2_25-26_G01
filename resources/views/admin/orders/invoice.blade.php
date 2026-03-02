<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn #{{ $order->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; }
        .invoice-header { margin-bottom: 2rem; }
        .table th, .table td { vertical-align: middle; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container py-5">
        <div class="invoice-header text-center">
            <h2>HÓA ĐƠN BÁN HÀNG</h2>
            <p><strong>Đơn hàng #{{ $order->id }}</strong></p>
        </div>

        <div class="row mb-4">
            <div class="col-6">
                <h5>Khách hàng</h5>
                <p>{{ $order->customer_name }}</p>
                <p>{{ $order->customer_phone }}</p>
                <p>{{ $order->customer_address }}</p>
            </div>
            <div class="col-6 text-end">
                <h5>Ngày đặt</h5>
                <p>{{ $order->created_at->format('d/m/Y H:i') }}</p>
                <h5>Trạng thái</h5>
                <p>{{ ucfirst($order->status) }}</p>
            </div>
        </div>

        <table class="table table-bordered">
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

        <div class="text-center mt-5 no-print">
            <button onclick="window.print()" class="btn btn-primary">In lại</button>
        </div>
    </div>
</body>
</html>