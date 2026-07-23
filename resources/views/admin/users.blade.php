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
            <h3 class="fw-bold text-primary m-0">👥 إدارة المستخدمين</h3>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4 fw-bold">🔙 عودة للوحة التحكم</a>
        </div>

        @if(session('success'))
        <div class="alert alert-success rounded-3 fw-bold">{{ session('success') }}</div>
        @endif

        <div class="card border-0 shadow-sm p-4 bg-white rounded-4">
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center align-middle m-0">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>البريد الإلكتروني</th>
                            <th>تاريخ الانضمام</th>
                            <th>الصلاحية</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td class="fw-bold">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                            <td>
                                @if($user->role === 'admin')
                                <span class="badge bg-danger px-3 py-2 rounded-pill">أدمن</span>
                                @else
                                <span class="badge bg-secondary px-3 py-2 rounded-pill">مستخدم</span>
                                @endif
                            </td>
                            <td>
                                @if($user->role !== 'admin')
                                <!-- تم تعديل الـ action هنا لرابط مباشر عشان مديش إيرور Route not defined -->
                                <form action="{{ url('/admin/users/' . $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('⚠️ متأكد إنك عايز تمسح المستخدم ده نهائياً؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger fw-bold shadow-sm px-3 rounded-pill">🗑️ مسح</button>
                                </form>
                                @else
                                <span class="text-muted small fw-semibold">لا يمكن الحذف</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-muted fw-bold py-4">لا يوجد مستخدمين حتى الآن.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>