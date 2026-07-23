<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>الإشعارات</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
</head>

<body class="bg-light">
    <div class="container py-5" style="max-width: 800px;">
        <div class="d-flex justify-content-between align-items-center mb-4 p-4 bg-white rounded-4 shadow-sm">
            <h3 class="fw-bold m-0 text-dark">🔔 الإشعارات الخاصة بك</h3>
            <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('posts.index') }}" class="btn btn-outline-secondary rounded-pill px-4 fw-bold">🔙 عودة</a>
        </div>

        <div class="list-group shadow-sm rounded-4 overflow-hidden border-0 bg-white p-3">
            @forelse ($notifications as $n)
            <div class="list-group-item list-group-item-action p-4 d-flex justify-content-between align-items-center border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <span class="fs-3">📢</span>
                    <div>
                        <p class="mb-1 fw-bold text-dark fs-5">{{ $n->message }}</p>
                        <small class="text-muted fw-semibold">{{ $n->created_at->diffForHumans() }}</small>
                    </div>
                </div>
                @if(!$n->is_read)
                <span class="badge bg-primary px-3 py-2 rounded-pill shadow-sm">جديد</span>
                @endif
            </div>
            @empty
            <div class="text-center py-5 bg-white text-muted">
                <h4 class="m-0 fw-bold">📭 لا توجد إشعارات حالياً.</h4>
            </div>
            @endforelse
        </div>
    </div>
</body>

</html>