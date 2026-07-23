<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>جميع المقالات</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('posts.index') }}">🚀 منصة المقالات</a>
            <div class="d-flex align-items-center gap-3">
                @auth
                <span class="text-white">أهلاً، {{ auth()->user()->name }}</span>
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-warning btn-sm">لوحة الأدمن</a>
                @endif
                <a href="{{ route('notifications') }}" class="btn btn-outline-light btn-sm">🔔 الإشعارات</a>
                <form action="{{ route('users.logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">تسجيل خروج</button>
                </form>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">📚 أحدث المقالات</h2>
            <a href="{{ route('posts.create') }}" class="btn btn-primary fw-semibold px-4 rounded-pill">➕ إضافة مقال جديد</a>
        </div>

        @if(session('success'))
        <div class="alert alert-success fw-semibold">{{ session('success') }}</div>
        @endif

        <div class="row g-4">
            @forelse($posts as $post)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                    @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="صورة المقال">
                    @else
                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                        <span>بدون صورة</span>
                    </div>
                    @endif
                    <div class="card-body p-4 d-flex flex-column">
                        <h4 class="fw-bold text-dark mb-2">{{ $post->title }}</h4>
                        <p class="text-muted small mb-3">كتب بواسطة: <span class="fw-bold text-primary">{{ $post->user->name ?? 'مجهول' }}</span></p>
                        <p class="card-text text-secondary mb-4">{{ Str::limit($post->content, 100) }}</p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-dark btn-sm rounded-pill px-3">قراءة المزيد ➔</a>

                            @if(auth()->id() === $post->user_id || auth()->user()->role === 'admin')
                            <div class="d-flex gap-2">
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-outline-secondary rounded-pill">✏️</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">🗑️</button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-5 text-muted">
                <h4>📭 لا توجد مقالات منشورة حتى الآن.</h4>
            </div>
            @endforelse
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>