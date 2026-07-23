<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>منصة المقالات</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-custom {
            background: linear-gradient(135deg, #2b2d42 0%, #1a1b28 100%);
            padding: 15px 0;
        }

        .card {
            border: none;
            border-radius: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    @auth
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom mb-5 shadow">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand fw-bold fs-4" href="{{ route('posts.index') }}">🚀 منصة المقالات</a>

            <div class="d-flex align-items-center gap-3">

                <a href="{{ route('admin.dashboard') }}" class="btn btn-warning btn-sm rounded-pill px-3 fw-bold shadow-sm text-dark">
                    ⚙️ لوحة التحكم
                </a>

                <span class="text-white fw-semibold bg-white bg-opacity-10 px-3 py-1 rounded-pill">
                    أهلاً، {{ auth()->user()->name }} 👤
                </span>

                <form action="{{ route('users.logout') }}" method="POST" class="m-0">
                    @csrf
                    <button class="btn btn-danger btn-sm rounded-pill px-4 fw-bold shadow-sm">تسجيل خروج</button>
                </form>
            </div>
        </div>
    </nav>
    @endauth

    <div class="container pb-5">
        <div class="d-flex justify-content-between align-items-center mb-5 mt-2">
            <h2 class="fw-bold text-dark m-0">📚 أحدث المقالات</h2>
            <a href="{{ route('posts.create') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border: none;">
                ➕ إضافة مقال جديد
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-success rounded-pill text-center fw-bold shadow-sm mb-4 border-0">
            ✅ {{ session('success') }}
        </div>
        @endif

        <div class="row g-4">
            @forelse($posts as $post)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 bg-white shadow-sm border-0 rounded-4">
                    <div class="card-body d-flex flex-column p-4">
                        <h4 class="card-title fw-bold text-dark mb-3">{{ $post->title }}</h4>
                        <p class="card-text text-muted mb-4" style="font-size: 0.95rem; line-height: 1.6; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                            {{ $post->content }}
                        </p>
                        <div class="mt-auto d-flex justify-content-between align-items-center pt-3 border-top">
                            <span class="text-secondary small fw-bold">
                                ✍️ {{ $post->user->name ?? 'مجهول' }}
                            </span>
                            <div class="btn-group shadow-sm rounded-pill">
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-outline-primary fw-bold px-3 border-end-0" style="border-top-right-radius: 50px; border-bottom-right-radius: 50px;">عرض</a>
                                @if(auth()->id() == $post->user_id)
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-outline-secondary fw-bold px-3" style="border-top-left-radius: 50px; border-bottom-left-radius: 50px;">تعديل</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="bg-white p-5 rounded-4 shadow-sm">
                    <h3 class="text-muted fw-bold mb-3">لا توجد مقالات حتى الآن 📭</h3>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</body>

</html>