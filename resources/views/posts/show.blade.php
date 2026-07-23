<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>{{ $post->title }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <style>
        body {
            background-color: #f4f7f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-custom {
            background: linear-gradient(135deg, #2b2d42 0%, #1a1b28 100%);
            padding: 15px 0;
        }

        .card {
            border: none;
            border-radius: 15px;
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
            box-shadow: 0 5px 15px rgba(79, 172, 254, 0.4);
        }

        .comment-box {
            background-color: #fdfdfd;
            border-radius: 12px;
            border-right: 4px solid #4facfe;
            transition: 0.3s;
        }

        .comment-box:hover {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>

    <!-- الناف بار -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom mb-5 shadow">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand fw-bold fs-4" href="{{ route('posts.index') }}">🚀 منصة المقالات</a>
            <div class="d-flex align-items-center gap-3">
                <span class="text-white fw-semibold bg-white bg-opacity-10 px-3 py-1 rounded-pill">
                    أهلاً، {{ auth()->user()->name ?? 'زائر' }} 👤
                </span>
            </div>
        </div>
    </nav>

    <div class="container pb-5" style="max-width: 850px;">

        <!-- تفاصيل المقال -->
        <div class="card shadow-sm mb-5 p-4 p-md-5 bg-white">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                <h2 class="fw-bold text-dark m-0">{{ $post->title }}</h2>
                <a href="{{ route('posts.index') }}" class="btn btn-light border shadow-sm rounded-pill px-4 fw-bold">رجوع ↩️</a>
            </div>

            <div class="d-flex align-items-center text-muted mb-4 small fw-semibold">
                <span class="me-4"><i class="bi bi-person"></i> ✍️ الكاتب: {{ $post->user->name ?? 'مجهول' }}</span>
                <span><i class="bi bi-calendar"></i> 📅 النشر: {{ $post->created_at->format('Y-m-d') }}</span>
            </div>

            @if($post->image)
            <div class="text-center mb-4">
                <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded-4 shadow-sm" alt="Post Image" style="max-height: 450px; object-fit: cover; width: 100%;">
            </div>
            @endif

            <p class="fs-5 text-dark" style="line-height: 1.9; text-align: justify;">
                {{ $post->content }}
            </p>

            <!-- أزرار التعديل والحذف (تظهر لصاحب المقال فقط) -->
            @if(auth()->id() == $post->user_id)
            <div class="mt-5 pt-3 border-top d-flex justify-content-end gap-2">
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-outline-secondary rounded-pill px-4 fw-bold">✏️ تعديل</a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="m-0" onsubmit="return confirm('هل أنت متأكد من حذف هذا المقال نهائياً؟');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm">🗑️ حذف</button>
                </form>
            </div>
            @endif
        </div>

        <!-- قسم التعليقات -->
        <div class="card shadow-sm p-4 p-md-5 bg-white">
            <h4 class="fw-bold mb-4 text-dark border-bottom pb-3">💬 التعليقات</h4>

            <!-- فورم إضافة تعليق -->
            <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mb-5">
                @csrf
                <div class="form-floating mb-3">
                    <textarea name="body" class="form-control rounded-3 bg-light" id="commentInput" placeholder="اكتب تعليقك هنا..." style="height: 110px" required></textarea>
                    <label for="commentInput" class="text-muted fw-semibold">أضف تعليقاً يثري النقاش...</label>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-gradient rounded-pill px-5 py-2 fw-bold shadow-sm">إرسال التعليق 🚀</button>
                </div>
            </form>

            <!-- عرض التعليقات -->
            <div class="d-flex flex-column gap-3">
                @forelse($post->comments as $comment)
                <div class="comment-box p-3 shadow-sm border">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <strong class="text-primary fs-6">{{ $comment->user->name ?? 'مستخدم' }}</strong>
                        <small class="text-muted fw-semibold">{{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-0 text-dark" style="font-size: 0.95rem;">{{ $comment->body }}</p>
                </div>
                @empty
                <div class="text-center text-muted py-5 bg-light rounded-4">
                    <h5 class="fw-bold mb-2">لا توجد تعليقات حتى الآن 📭</h5>
                    <p class="mb-0">كن أول من يشارك برأيه في هذا المقال!</p>
                </div>
                @endforelse
            </div>
        </div>

    </div>

</body>

</html>