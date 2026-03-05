<x-app-layout>
    <div class="container py-5">
        <h1 class="mb-4">Quản Trị Hệ Thống</h1>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5>Tổng đơn hàng</h5>
                        <h2>{{ $totalOrders }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5>Đơn chờ xử lý</h5>
                        <h2>{{ $pendingOrders }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5>Tổng sản phẩm</h5>
                        <h2>{{ $totalBreads }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5>Tổng người dùng</h5>
                        <h2>{{ $totalUsers }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Biểu đồ doanh thu (30 ngày gần nhất)</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="revenueChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Đơn hàng gần đây</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Mã</th>
                                        <th>Khách hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOrders as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ $order->customer_name }}</td>
                                        <td>{{ number_format($order->total_amount) }}đ</td>
                                        <td>
                                            <span class="badge bg-warning">{{ $order->status }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Quản lý nhanh</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.breads.index') }}" class="btn btn-outline-primary">
                                📦 Quản lý bánh mì
                            </a>
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-success">
                                📋 Quản lý đơn hàng
                            </a>
                            <a href="{{ route('admin.breads.create') }}" class="btn btn-outline-info">
                                ➕ Thêm bánh mì mới
                            </a>
                            <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary">
                                📰 Quản lý tin tức & khuyến mãi
                            </a>
                            <a href="{{ route('admin.promo-codes.index') }}" class="btn btn-outline-danger">
                                🏷️ Quản lý mã giảm giá
                            </a>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-warning">
                                👥 Quản lý người dùng
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    (function() {
        const ctx = document.getElementById('revenueChart');
        if (!ctx) return;

        fetch("{{ route('admin.revenue.data') }}?days=30")
            .then(res => res.json())
            .then(json => {
                const labels = json.labels.map(l => l.replace(/\-/g, '/'));
                const data = json.data;

                new Chart(ctx.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Doanh thu (VNĐ)',
                            data: data,
                            borderColor: '#0d6efd',
                            backgroundColor: 'rgba(13,110,253,0.1)',
                            tension: 0.2,
                            fill: true,
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: true },
                            tooltip: { mode: 'index', intersect: false }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value){
                                        return new Intl.NumberFormat('vi-VN').format(value) + 'đ';
                                    }
                                }
                            }
                        }
                    }
                });
            })
            .catch(err => console.error('Fetch revenue data failed', err));
    })();
</script>