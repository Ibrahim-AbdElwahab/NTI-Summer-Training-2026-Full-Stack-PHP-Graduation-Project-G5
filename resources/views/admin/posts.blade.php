<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>إدارة المقالات</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4 p-4 bg-white rounded-4 shadow-sm">
            <h3 class="fw-bold m-0">📝 إدارة المقالات</h3>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">🔙 عودة للوحة التحكم</a>
        </div>

        @if (session('success'))
        <div class="alert alert-success fw-semibold">{{ session('success') }}</div>
        @endif

        <div class="card border-0 rounded-4 shadow-sm overflow-hidden">
            <table class="table table-hover align-middle m-0 text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>عنوان المقال</th>
                        <th>الكاتب</th>
                        <th>تاريخ النشر</th>
                        <th>إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-bold">{{ $post->title }}</td>
                        <td><span class="badge bg-info text-dark px-3">{{ $post->user->name ?? 'غير معروف' }}</span></td>
                        <td class="text-muted" dir="ltr">{{ $post->created_at->format('Y-m-d') }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.posts.delete', $post->id) }}" onsubmit="return confirm('هل أنت متأكد من حذف هذا المقال؟ سيتم إرسال إشعار لصاحبه.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger px-3">🗑️ حذف</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-4 text-muted">لا توجد مقالات منشورة حالياً.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>