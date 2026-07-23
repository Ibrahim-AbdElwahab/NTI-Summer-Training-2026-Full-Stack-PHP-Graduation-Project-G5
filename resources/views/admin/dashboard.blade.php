<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>لوحة تحكم المسؤول</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .hover-card {
            transition: all 0.3s ease-in-out;
            cursor: pointer;
        }

        .hover-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.15) !important;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5 p-4 bg-white rounded-4 shadow-sm">
            <h2 class="fw-bold m-0 text-primary">🛡️ لوحة تحكم المسؤول</h2>
            <a href="{{ route('posts.index') }}" class="btn btn-outline-dark fw-bold rounded-pill px-4">🏠 العودة للموقع</a>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <a href="{{ route('admin.users') }}" class="text-decoration-none">
                    <div class="card border-0 bg-primary text-white rounded-4 shadow py-4 text-center hover-card">
                        <div class="card-body">
                            <h1 class="display-4 fw-bold mb-2">{{ $usersCount }}</h1>
                            <h5 class="m-0 fw-bold">👥 إجمالي المستخدمين</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('admin.posts') }}" class="text-decoration-none">
                    <div class="card border-0 bg-success text-white rounded-4 shadow py-4 text-center hover-card">
                        <div class="card-body">
                            <h1 class="display-4 fw-bold mb-2">{{ $postsCount }}</h1>
                            <h5 class="m-0 fw-bold">📝 إجمالي المقالات</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="card border-0 bg-white rounded-4 shadow-sm p-4">
            <h4 class="fw-bold mb-4">⚙️ إدارة النظام</h4>
            <div class="d-flex gap-3 flex-wrap">
                <a href="{{ route('admin.users') }}" class="btn btn-lg btn-outline-primary fw-bold px-4 rounded-pill">👥 إدارة المستخدمين</a>
                <a href="{{ route('admin.posts') }}" class="btn btn-lg btn-outline-success fw-bold px-4 rounded-pill">📝 إدارة المقالات</a>
                <a href="{{ route('notifications') }}" class="btn btn-lg btn-outline-warning text-dark fw-bold px-4 rounded-pill">🔔 الإشعارات</a>
            </div>
        </div>
    </div>
</body>

</html>