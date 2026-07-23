//صفحة عشان نعمل منشور جديد
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>إضافة مقال جديد</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
</head>

<body class="bg-light">

    <div class="container py-5" style="max-width: 700px;">
        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
            <h3 class="fw-bold mb-4">✍️ إنشاء مقال جديد</h3>

            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">عنوان المقال</label>
                    <input type="text" name="title" class="form-control rounded-3" value="{{ old('title') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">محتوى المقال</label>
                    <textarea name="content" class="form-control rounded-3" rows="6" required>{{ old('content') }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">صورة الغلاف (اختياري)</label>
                    <input type="file" name="image" class="form-control rounded-3">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary rounded-3">إلغاء</a>
                    <button type="submit" class="btn btn-dark px-4 rounded-3 fw-semibold">نشر المقال 🚀</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>