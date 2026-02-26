<x-app-layout>
    <div class="container py-5">
        <h1 class="mb-4">Giỏ hàng</h1>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(empty($cart))
        <div class="alert alert-info">
            Giỏ hàng trống. <a href="{{ route('home') }}">Tiếp tục mua sắm</a>
        </div>
        @else
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $item)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($item['image'])
                                <img src="{{asset('images/breads/' . $item['image'])}}" width="50" class="me-2">
                                @endif
                                {{ $item['name']}}
                            </div>
                        </td>
                        <td>{{ number_format($item['price']) }}đ</td>
                        <td>
                            <form action="{{route('cart.update', $id)}}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control" style="width:80px;" onchange="this.form.submit()">
                            </form>
                        </td>
                        <td class="fw-bold">{{number_format($item['price'] * $item['quantity'])  }} đ</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Xóa sản phẩm này?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                        <td colspan="2" class="text-danger fs-5 fw-bold">{{ number_format($total) }} đ</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="mt-4">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary">← Tiếp tục mua</a>
            <a href="{{ route('checkout') }}" class="btn btn-success float-end">Đặt hàng →</a>
        </div>
        @endif
    </div>
</x-app-layout>