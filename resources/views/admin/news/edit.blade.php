<x-app-layout>
    <div class="container py-5">
        <h1 class="mb-4">Chỉnh sửa tin tức</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @include('admin.news._form')

                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Hủy</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
