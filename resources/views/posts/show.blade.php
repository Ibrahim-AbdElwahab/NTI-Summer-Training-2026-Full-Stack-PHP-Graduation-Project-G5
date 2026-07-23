<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>{{ $post->title }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
</head>

<body class="bg-light">

    <div class="container py-5" style="max-width: 900px;">
        <a href="{{ route('posts.index') }}" class="btn btn-outline-dark mb-4 rounded-pill">⬅ العودة لكل المقالات</a>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
            @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" class="w-100" style="max-height: 400px; object-fit: cover;" alt="صورة المقال">
            @endif
            <div class="card-body p-4 p-md-5">
                <h1 class="fw-bold text-dark mb-3">{{ $post->title }}</h1>
                <div class="d-flex justify-content-between align-items-center text-muted mb-4 pb-3 border-bottom">
                    <span>👤 بواسطة: <strong class="text-primary">{{ $post->user->name ?? 'مجهول' }}</strong></span>
                    <span>📅 {{ $post->created_at->format('Y-m-d') }}</span>
                </div>
                <p class="fs-5 text-secondary" style="line-height: 1.8;">
                    {!! nl2br(e($post->content)) !!}
                </p>
            </div>
        </div>

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4 p-md-5">

                <h4 class="fw-bold mb-4">💬 التعليقات ({{ $post->comments->count() }})</h4>

                @if(session('success'))
                <div class="alert alert-success text-center fw-semibold py-2 border-0 shadow-sm rounded-3">
                    ✅ {{ session('success') }}
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-danger text-center fw-semibold py-2 border-0 shadow-sm rounded-3">
                    ⚠️ {{ $errors->first() }}
                </div>
                @endif

                <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mb-5">
                    @csrf
                    <div class="mb-3">
                        <textarea name="body" class="form-control rounded-3" rows="3" placeholder="اكتب تعليقك هنا يا {{ auth()->user()->name }}..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-dark px-4 fw-semibold rounded-3">إرسال التعليق ➔</button>
                </form>

                <hr class="my-4 text-muted">

                <div class="comments-list">
                    @forelse($post->comments as $comment)
                    <div class="card mb-3 border bg-light rounded-3 shadow-sm">
                        <div class="card-body p-3 p-md-4">

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="fw-bold text-primary mb-0">👤 {{ $comment->user->name }}</h6>
                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                            </div>

                            <p class="card-text text-dark mb-3" style="line-height: 1.7;">{{ $comment->body }}</p>

                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <form action="{{ route('comments.like', $comment->id) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ method_exists($comment, 'isLikedByAuthUser') && $comment->isLikedByAuthUser() ? 'btn-danger' : 'btn-outline-danger' }} rounded-pill px-3">
                                        🤍 إعجاب
                                        <span class="badge bg-white text-danger ms-1">{{ $comment->likes->count() }}</span>
                                    </button>
                                </form>

                                @if($comment->user_id === auth()->id())
                                <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" type="button" data-bs-toggle="collapse" data-bs-target="#edit-comment-{{ $comment->id }}">
                                    ✏️ تعديل
                                </button>

                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="m-0" onsubmit="return confirm('هل أنت متأكد من حذف هذا التعليق؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-dark rounded-pill px-3">🗑️ حذف</button>
                                </form>
                                @endif
                            </div>

                            @if($comment->user_id === auth()->id())
                            <div class="collapse mt-3" id="edit-comment-{{ $comment->id }}">
                                <div class="card card-body border-0 bg-white shadow-sm rounded-3 p-3">
                                    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-2">
                                            <textarea name="body" class="form-control form-control-sm rounded-3" rows="2" required>{{ $comment->body }}</textarea>
                                        </div>
                                        <div class="d-flex justify-content-end gap-2">
                                            <button type="button" class="btn btn-sm btn-light" data-bs-toggle="collapse" data-bs-target="#edit-comment-{{ $comment->id }}">إلغاء</button>
                                            <button type="submit" class="btn btn-sm btn-success px-3 fw-semibold">حفظ</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5 text-muted">
                        <h5>📭 لا توجد تعليقات حتى الآن..</h5>
                    </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>