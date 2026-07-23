<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>تعديل المقال</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
</head>

<body class="bg-light">

    <div class="container py-5" style="max-width: 700px;">
        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
            <h3 class="fw-bold mb-4 text-primary">✏️ تعديل المقال</h3>

            @if($errors->any())
            <div class="alert alert-danger rounded-3 shadow-sm border-0">
                <ul class="mb-0 text-start" dir="ltr">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">عنوان المقال</label>
                    <input type="text" name="title" class="form-control rounded-3" value="{{ old('title', $post->title) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">محتوى المقال</label>
                    <textarea name="content" class="form-control rounded-3" rows="6" required>{{ old('content', $post->content) }}</textarea>
                </div>

                @if($post->image)
                <div class="mb-3">
                    <label class="form-label d-block text-muted small">الصورة الحالية:</label>
                    <img src="{{ asset('storage/' . $post->image) }}" class="rounded-3 shadow-sm" style="height: 100px; object-fit: cover;">
                </div>
                @endif

                <div class="mb-4">
                    <label class="form-label fw-semibold">تغيير الصورة (اختياري)</label>
                    <input type="file" name="image" class="form-control rounded-3">
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary rounded-3 px-4">إلغاء</a>
                    <button type="submit" class="btn btn-primary px-4 rounded-3 fw-semibold">حفظ التعديلات 🚀</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>