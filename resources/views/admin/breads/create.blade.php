<x-app-layout>
    <div class="container py-5">
        <h1 class="mb-4">Thêm Bánh Mì Mới</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.breads.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Tên bánh mì *</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mô tả</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Giá *</label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                value="{{ old('price') }}" required>
                            @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tồn kho *</label>
                            <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
                                value="{{ old('stock', 0) }}" required>
                            @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Loại (type) *</label>
                        <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                            <option value="sweet" {{ old('type')=='sweet' ? 'selected' : '' }}>Bánh ngọt</option>
                            <option value="salty" {{ old('type')=='salty' ? 'selected' : '' }}>Bánh mặn</option>
                            <option value="other" {{ old('type')=='other' ? 'selected' : '' }}>Khác</option>
                        </select>
                        @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Chọn ảnh từ thư mục (hoặc để trống để upload ảnh mới)</label>
                        <select name="image_from_folder" class="form-select mb-2" id="imageSelect">
                            <option value="">-- Chọn ảnh từ thư mục public/images/breads --</option>
                            @php
                                $imagePath = public_path('images/breads');
                                $images = [];
                                if (is_dir($imagePath)) {
                                    $files = scandir($imagePath);
                                    foreach ($files as $file) {
                                        if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'svg', 'jfif', 'webp'])) {
                                            $images[] = $file;
                                        }
                                    }
                                }
                            @endphp
                            @foreach($images as $img)
                            <option value="images/breads/{{ $img }}" {{ old('image_from_folder') == 'images/breads/' . $img ? 'selected' : '' }}>
                                {{ $img }}
                            </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Hoặc upload ảnh mới bên dưới (sẽ ghi đè lựa chọn trên)</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Hoặc upload ảnh mới</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="is_available" class="form-check-input"
                                id="is_available" value="1" {{ old('is_available', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_available">Còn bán</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <a href="{{ route('admin.breads.index') }}" class="btn btn-secondary">Hủy</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>