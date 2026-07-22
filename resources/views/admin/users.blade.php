<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>إدارة المستخدمين</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4 p-4 bg-white rounded-4 shadow-sm">
            <h3 class="fw-bold m-0">👥 إدارة المستخدمين</h3>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">🔙 عودة للوحة التحكم</a>
        </div>

        @if (session('success'))
        <div class="alert alert-success fw-semibold">{{ session('success') }}</div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger fw-semibold">{{ session('error') }}</div>
        @endif

        <div class="card border-0 rounded-4 shadow-sm overflow-hidden">
            <table class="table table-hover align-middle m-0 text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>الدور (Role)</th>
                        <th>إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-bold">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge {{ $user->role === 'admin' ? 'bg-danger' : 'bg-secondary' }} px-3 py-2">
                                {{ $user->role === 'admin' ? 'مسؤول' : 'مستخدم' }}
                            </span>
                        </td>
                        <td>
                            @if($user->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.users.delete', $user->id) }}" onsubmit="return confirm('هل أنت متأكد من حذف هذا المستخدم؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger px-3">🗑️ حذف</button>
                            </form>
                            @else
                            <span class="text-muted small">حسابك الحالي</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>