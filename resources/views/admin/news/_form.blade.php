@csrf

<div class="mb-3">
    <label class="form-label">Tiêu đề *</label>
    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $news->title ?? '') }}" required>
    @error('title')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Slug (URL) - để trống để tự tạo</label>
    <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $news->slug ?? '') }}">
    @error('slug')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Mô tả ngắn</label>
    <textarea name="excerpt" class="form-control @error('excerpt') is-invalid @enderror" rows="2">{{ old('excerpt', $news->excerpt ?? '') }}</textarea>
    @error('excerpt')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Nội dung *</label>
    <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="6">{{ old('content', $news->content ?? '') }}</textarea>
    @error('content')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Chọn ảnh từ thư mục (public/images/news)</label>
    <select name="image_from_folder" class="form-select mb-2">
        <option value="">-- Chọn ảnh từ thư mục --</option>
        @php
            $imagePath = public_path('images/news');
            $images = [];
            if (is_dir($imagePath)) {
                $files = scandir($imagePath);
                foreach ($files as $file) {
                    if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg','jpeg','png','gif','webp','svg'])) {
                        $images[] = $file;
                    }
                }
            }
        @endphp
        @foreach($images as $img)
        <option value="images/news/{{ $img }}" {{ old('image_from_folder', $news->image ?? '') == 'images/news/' . $img ? 'selected' : '' }}>{{ $img }}</option>
        @endforeach
    </select>
    <small class="text-muted">Hoặc upload ảnh mới bên dưới</small>
</div>

<div class="mb-3">
    <label class="form-label">Hoặc upload ảnh mới</label>
    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
    @error('image')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Ngày đăng</label>
    <input type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at', isset($news) && $news->published_at ? $news->published_at->format('Y-m-d\TH:i') : '') }}">
</div>

<div class="mb-3">
    <div class="form-check">
        <input type="checkbox" name="is_published" class="form-check-input" id="is_published" value="1" {{ old('is_published', $news->is_published ?? false) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_published">Đã đăng</label>
    </div>
</div>
