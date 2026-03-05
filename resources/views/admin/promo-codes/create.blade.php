<x-app-layout>
    <div class="container py-4">
        <h1 class="mb-4">Tạo Mã Giảm Giá Mới</h1>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.promo-codes.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="code" class="form-label">Mã Giảm Giá *</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror" 
                                       id="code" name="code" placeholder="VD: WELCOME10" 
                                       value="{{ old('code') }}" required maxlength="20">
                                <small class="text-muted">Mã sẽ được chuyển thành chữ in hoa</small>
                                @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="discount_type" class="form-label">Loại Giảm Giá *</label>
                                        <select class="form-select @error('discount_type') is-invalid @enderror" 
                                                id="discount_type" name="discount_type" required 
                                                onchange="updateDiscountLabel()">
                                            <option value="">-- Chọn loại --</option>
                                            <option value="fixed" {{ old('discount_type') === 'fixed' ? 'selected' : '' }}>Cố Định (đ)</option>
                                            <option value="percentage" {{ old('discount_type') === 'percentage' ? 'selected' : '' }}>Phần Trăm (%)</option>
                                        </select>
                                        @error('discount_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="discount_value" class="form-label">Giá Trị Giảm Giá <span id="unit">*</span></label>
                                        <input type="number" class="form-control @error('discount_value') is-invalid @enderror" 
                                               id="discount_value" name="discount_value" 
                                               placeholder="0" value="{{ old('discount_value') }}" 
                                               step="0.01" min="0" required>
                                        @error('discount_value')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="max_usage" class="form-label">Số Lần Sử Dụng Tối Đa</label>
                                        <input type="number" class="form-control @error('max_usage') is-invalid @enderror" 
                                               id="max_usage" name="max_usage" placeholder="Để trống = không giới hạn" 
                                               value="{{ old('max_usage') }}" min="1">
                                        <small class="text-muted">Để trống nếu không muốn giới hạn</small>
                                        @error('max_usage')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="expires_at" class="form-label">Ngày Hết Hạn</label>
                                        <input type="date" class="form-control @error('expires_at') is-invalid @enderror" 
                                               id="expires_at" name="expires_at" value="{{ old('expires_at') }}">
                                        <small class="text-muted">Để trống nếu không muốn hạn chế thời gian</small>
                                        @error('expires_at')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Mô Tả</label>
                                <input type="text" class="form-control @error('description') is-invalid @enderror" 
                                       id="description" name="description" placeholder="VD: Giảm 10% cho khách hàng mới" 
                                       value="{{ old('description') }}" maxlength="255">
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="is_active" 
                                       name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Kích Hoạt Mã Này
                                </label>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Tạo Mã Giảm Giá</button>
                                <a href="{{ route('admin.promo-codes.index') }}" class="btn btn-secondary">Hủy</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-light">
                    <div class="card-body">
                        <h5>Hướng Dẫn</h5>
                        <ul class="small">
                            <li><strong>Mã Giảm Giá:</strong> Mã duy nhất, không trùng lặp</li>
                            <li><strong>Loại Giảm:</strong>
                                <ul>
                                    <li>Cố Định: Giảm một số tiền nhất định (VD: 50.000đ)</li>
                                    <li>Phần Trăm: Giảm theo tỷ lệ phần trăm (VD: 10%)</li>
                                </ul>
                            </li>
                            <li><strong>Giá Trị:</strong> Mức giảm giá cụ thể</li>
                            <li><strong>Sử Dụng:</strong> Giới hạn số lần dùng (tùy chọn)</li>
                            <li><strong>Hết Hạn:</strong> Thời gian hết hạn (tùy chọn)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateDiscountLabel() {
            const type = document.getElementById('discount_type').value;
            const unit = document.getElementById('unit');
            const input = document.getElementById('discount_value');
            
            if (type === 'percentage') {
                unit.textContent = '(%) *';
                input.placeholder = '10';
                input.max = '100';
            } else if (type === 'fixed') {
                unit.textContent = '(đ) *';
                input.placeholder = '50000';
                input.max = '';
            }
        }
    </script>
</x-app-layout>
