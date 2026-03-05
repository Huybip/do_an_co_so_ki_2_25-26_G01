<x-app-layout>
    <div class="container py-5">
        <h1 class="mb-4">Đặt Hàng</h1>
        
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h5>Thông tin giao hàng</h5>
                        <small class="text-muted">
                            💰 Thanh toán khi nhận hàng (COD)
                        </small>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('order.store') }}" method="POST" id="orderForm">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Họ tên *</label>
                                <input type="text" name="customer_name" class="form-control" 
                                       value="{{ auth()->user()->name ?? old('customer_name') }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Số điện thoại *</label>
                                <input type="text" name="customer_phone" class="form-control" 
                                       value="{{ auth()->user()->phone ?? old('customer_phone') }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Địa chỉ giao hàng *</label>
                                <textarea name="customer_address" class="form-control" rows="3" required>{{ auth()->user()->address ?? old('customer_address') }}</textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Ghi chú (tùy chọn)</label>
                                <textarea name="note" class="form-control" rows="2">{{ old('note') }}</textarea>
                            </div>

                            <!-- Input hidden cho mã giảm giá -->
                            <input type="hidden" name="promo_code" id="promoCodeInput">
                            
                            <button type="submit" class="btn btn-success btn-lg w-100">
                                Đặt hàng (COD)
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h5>Đơn hàng của bạn</h5>
                    </div>
                    <div class="card-body">
                        @foreach($cart as $item)
                            <div class="d-flex justify-content-between mb-2">
                                <span>{{ $item['name'] }} x {{ $item['quantity'] }}</span>
                                <span>{{ number_format($item['price'] * $item['quantity']) }} đ</span>
                            </div>
                        @endforeach
                        
                        <hr>
                        
                        <!-- Mã giảm giá -->
                        <div class="mb-3">
                            <label class="form-label">Mã giảm giá</label>
                            <div class="input-group">
                                <input type="text" id="promoCode" placeholder="Nhập mã giảm giá" class="form-control" maxlength="20">
                                <button class="btn btn-primary" type="button" id="applyPromo">Áp dụng</button>
                            </div>
                            <div id="promoMessage" class="mt-2"></div>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <strong>Tổng tiền hàng:</strong>
                            <strong id="subtotal">{{ number_format($total) }} đ</strong>
                        </div>

                        <div id="discountRow" class="d-flex justify-content-between mb-2" style="display:none;">
                            <strong>Giảm giá:</strong>
                            <strong class="text-danger" id="discountAmount">-0 đ</strong>
                        </div>
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between">
                            <strong>Tổng thanh toán:</strong>
                            <strong class="text-danger fs-5" id="totalAmount">{{ number_format($total) }} đ</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const originalTotal = {{ $total }};
        let currentTotal = {{ $total }};
        let appliedPromoCode = null;

        document.getElementById('applyPromo').addEventListener('click', async function() {
            const code = document.getElementById('promoCode').value.trim();
            const messageDiv = document.getElementById('promoMessage');

            if (!code) {
                messageDiv.innerHTML = '<div class="alert alert-warning">Vui lòng nhập mã giảm giá!</div>';
                return;
            }

            // Disable button and show loading
            this.disabled = true;
            this.innerHTML = 'Đang kiểm tra...';

            try {
                const response = await fetch('{{ route("promo.validate") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        code: code,
                        total: originalTotal
                    })
                });

                const data = await response.json();

                if (data.valid) {
                    messageDiv.innerHTML = `<div class="alert alert-success">✓ ${data.message}</div>`;
                    document.getElementById('discountRow').style.display = 'flex';
                    document.getElementById('discountAmount').textContent = '-' + new Intl.NumberFormat('vi-VN').format(data.discount_amount) + ' đ';
                    document.getElementById('totalAmount').textContent = new Intl.NumberFormat('vi-VN').format(data.final_total) + ' đ';
                    document.getElementById('promoCodeInput').value = code.toUpperCase();
                    appliedPromoCode = code.toUpperCase();
                    currentTotal = data.final_total;

                    // Change button to remove
                    document.getElementById('applyPromo').textContent = 'Xóa';
                    document.getElementById('promoCode').disabled = true;
                } else {
                    messageDiv.innerHTML = `<div class="alert alert-danger">✗ ${data.message}</div>`;
                    document.getElementById('promoCodeInput').value = '';
                }
            } catch (error) {
                messageDiv.innerHTML = '<div class="alert alert-danger">Có lỗi xảy ra. Vui lòng thử lại!</div>';
                console.error('Error:', error);
            } finally {
                this.disabled = false;
                this.innerHTML = appliedPromoCode ? 'Xóa' : 'Áp dụng';
            }

            // Toggle to remove promo code if already applied
            if (appliedPromoCode) {
                document.getElementById('applyPromo').onclick = function() {
                    removePromoCode();
                };
            }
        });

        function removePromoCode() {
            document.getElementById('promoCode').value = '';
            document.getElementById('promoCode').disabled = false;
            document.getElementById('promoCodeInput').value = '';
            document.getElementById('promoMessage').innerHTML = '';
            document.getElementById('discountRow').style.display = 'none';
            document.getElementById('totalAmount').textContent = new Intl.NumberFormat('vi-VN').format(originalTotal) + ' đ';
            document.getElementById('applyPromo').textContent = 'Áp dụng';
            appliedPromoCode = null;
            
            document.getElementById('applyPromo').onclick = function() {
                document.getElementById('applyPromo').click();
            };
        }

        // Re-attach apply promo event listener on form submission
        document.getElementById('orderForm').addEventListener('submit', function(e) {
            // Just let the form submit with the promo code if set
        });
    </script>
</x-app-layout>