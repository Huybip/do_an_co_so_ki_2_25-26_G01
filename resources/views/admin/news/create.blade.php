<x-app-layout>
    <div class="container py-5">
        <h1 class="mb-4">Thêm tin tức / khuyến mãi mới</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                    @include('admin.news._form')

                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Hủy</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
