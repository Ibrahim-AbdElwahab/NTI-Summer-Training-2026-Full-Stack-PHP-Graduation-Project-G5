<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>إضافة مقال جديد</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
            min-height: 100vh;
        }

        .form-floating>label {
            right: 0;
            left: auto;
            padding-right: 1.25rem;
        }

        .btn-gradient {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border: none;
            color: white;
            transition: 0.3s;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            color: white;
            box-shadow: 0 10px 20px rgba(79, 172, 254, 0.3);
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center py-5">

    <div class="container" style="max-width: 800px;">
        <div class="card border-0 shadow-lg rounded-4 p-4 p-md-5 bg-white">

            <div class="d-flex justify-content-between align-items-center mb-5 border-bottom pb-3">
                <h3 class="fw-bold text-dark m-0">✨ كتابة مقال جديد</h3>
                <a href="{{ route('posts.index') }}" class="btn btn-light border shadow-sm rounded-pill px-4 fw-bold">رجوع ↩️</a>
            </div>

            @if($errors->any())
            <div class="alert alert-danger rounded-3 shadow-sm border-0">
                <ul class="mb-0 text-start" dir="ltr">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-floating mb-4">
                    <input type="text" name="title" class="form-control rounded-3" id="titleInput" placeholder="عنوان المقال" value="{{ old('title') }}" required>
                    <label for="titleInput" class="text-muted fw-semibold">عنوان المقال</label>
                </div>

                <div class="form-floating mb-4">
                    <textarea name="content" class="form-control rounded-3" id="contentInput" placeholder="اكتب مقالك هنا..." style="height: 200px" required>{{ old('content') }}</textarea>
                    <label for="contentInput" class="text-muted fw-semibold">محتوى المقال</label>
                </div>

                <div class="mb-5 bg-light p-3 rounded-3 border">
                    <label class="form-label fw-bold text-dark mb-2">إرفاق صورة (اختياري) 🖼️</label>
                    <input type="file" name="image" class="form-control bg-white">
                </div>

                <button type="submit" class="btn btn-gradient w-100 rounded-pill fw-bold fs-5 py-3">نشر المقال الآن 🚀</button>
            </form>

        </div>
    </div>

</body>

</html>