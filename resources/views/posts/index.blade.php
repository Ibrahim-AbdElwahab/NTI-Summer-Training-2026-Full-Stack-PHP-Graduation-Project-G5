<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>منصة المقالات</title>
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
            transition: all 0.3s ease;
            border-bottom: 4px solid transparent;
        }

        .card:hover {
            transform: translateY(-7px);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
            border-bottom: 4px solid #4facfe;
        }

        .btn-gradient {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border: none;
            color: white;
            transition: 0.3s;
        }

        .btn-gradient:hover {
            transform: scale(1.05);
            color: white;
            opacity: 0.9;
        }

        .text-truncate-3 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }
    </style>
</head>

<body>

    <!-- الناف بار (شريط التنقل العُلوي) -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom mb-5 shadow">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand fw-bold fs-4" href="{{ route('posts.index') }}">🚀 منصة المقالات</a>
            <div class="d-flex align-items-center gap-3">
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

    <!-- محتوى المقالات -->
    <div class="container pb-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h2 class="fw-bold text-dark m-0">📚 أحدث المقالات</h2>
            <a href="{{ route('posts.create') }}" class="btn btn-gradient rounded-pill px-4 py-2 fw-bold shadow-sm">
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
                <div class="card h-100 bg-white shadow-sm">
                    <div class="card-body d-flex flex-column p-4">
                        <h4 class="card-title fw-bold text-dark mb-3">{{ $post->title }}</h4>
                        <p class="card-text text-muted mb-4 text-truncate-3" style="font-size: 0.95rem; line-height: 1.6;">
                            {{ $post->content }}
                        </p>
                        <div class="mt-auto d-flex justify-content-between align-items-center pt-3 border-top">
                            <span class="text-secondary small fw-semibold">
                                ✍️ {{ $post->user->name ?? 'مجهول' }}
                            </span>
                            <div class="btn-group">
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-outline-primary fw-bold rounded-end-pill">عرض</a>
                                @if(auth()->id() == $post->user_id)
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-outline-secondary fw-bold rounded-start-pill">تعديل</a>
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
                    <p class="text-secondary">كن أول من يشارك أفكاره على المنصة!</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>

</body>

</html>