<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
            min-height: 100vh;
        }

        .card {
            border-radius: 1.25rem;
            border: none;
        }

        .btn-dark {
            background-color: #2b2d42;
            border: none;
            transition: 0.3s;
        }

        .btn-dark:hover {
            background-color: #1a1b28;
            transform: translateY(-2px);
        }

        .form-floating>label {
            right: 0;
            left: auto;
            padding-right: 1.25rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(43, 45, 66, 0.25);
            border-color: #2b2d42;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="card shadow-lg p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-dark">مرحباً بعودتك 👋</h2>
                        <p class="text-muted">سجل دخولك عشان تتابع أحدث المقالات</p>
                    </div>

                    @if($errors->any())
                    <div class="alert alert-danger rounded-3 shadow-sm border-0 fw-semibold text-center">
                        ⚠️ {{ $errors->first() }}
                    </div>
                    @endif

                    <form action="{{ route('users.login') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control rounded-3" id="emailInput" placeholder="البريد الإلكتروني" value="{{ old('email') }}" required>
                            <label for="emailInput">البريد الإلكتروني</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="password" name="password" class="form-control rounded-3" id="passInput" placeholder="كلمة المرور" required>
                            <label for="passInput">كلمة المرور</label>
                        </div>

                        <button type="submit" class="btn btn-dark w-100 rounded-pill fw-bold fs-5 py-2 mb-3 shadow-sm">دخول</button>

                        <div class="text-center mt-2">
                            <span class="text-muted">ليس لديك حساب؟</span>
                            <a href="{{ route('users.regist.view') }}" class="text-decoration-none fw-bold text-dark border-bottom border-dark pb-1">أنشئ حساباً جديداً</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>