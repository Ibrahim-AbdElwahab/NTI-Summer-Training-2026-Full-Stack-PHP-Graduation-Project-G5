<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>لوحة تحكم المسؤول</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
</head>

<body class="bg-light">

    <div class="container py-5">
        <!-- رأس الصفحة -->
        <div class="d-flex justify-content-between align-items-center mb-5 p-4 bg-white rounded-4 shadow-sm">
            <h2 class="fw-bold m-0 text-primary">🛡️ لوحة تحكم المسؤول (Admin Dashboard)</h2>
            <a href="{{ route('posts.index') }}" class="btn btn-outline-dark fw-semibold">🏠 العودة للموقع</a>
        </div>

        <!-- كروت الإحصائيات -->
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="card border-0 bg-primary text-white rounded-4 shadow py-4 text-center">
                    <div class="card-body">
                        <h1 class="display-4 fw-bold mb-2">{{ $usersCount }}</h1>
                        <h5 class="m-0">👥 إجمالي المستخدمين</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 bg-success text-white rounded-4 shadow py-4 text-center">
                    <div class="card-body">
                        <h1 class="display-4 fw-bold mb-2">{{ $postsCount }}</h1>
                        <h5 class="m-0">📝 إجمالي المقالات</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- أزرار التحكم السريع -->
        <div class="card border-0 bg-white rounded-4 shadow-sm p-4">
            <h4 class="fw-bold mb-4">⚙️ إدارة النظام</h4>
            <div class="d-flex gap-3 flex-wrap">
                <a href="{{ route('admin.users') }}" class="btn btn-lg btn-outline-primary fw-semibold px-4">👥 إدارة المستخدمين</a>
                <a href="{{ route('admin.posts') }}" class="btn btn-lg btn-outline-success fw-semibold px-4">📝 إدارة المقالات</a>
                <a href="{{ route('notifications') }}" class="btn btn-lg btn-outline-warning text-dark fw-semibold px-4">🔔 الإشعارات</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>