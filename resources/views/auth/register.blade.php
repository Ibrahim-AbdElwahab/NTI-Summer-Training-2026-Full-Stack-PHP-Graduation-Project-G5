<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>حساب جديد - منصة المقالات</title>
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

        .btn-gradient {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border: none;
            color: white;
            transition: 0.3s;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            color: white;
            box-shadow: 0 10px 20px rgba(79, 172, 254, 0.3);
        }

        .form-floating>label {
            right: 0;
            left: auto;
            padding-right: 1.25rem;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="card shadow-lg p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-dark">حساب جديد ✨</h2>
                        <p class="text-muted">انضم إلينا وشارك أفكارك مع الجميع</p>
                    </div>

                    @if($errors->any())
                    <div class="alert alert-danger rounded-3 shadow-sm border-0">
                        <ul class="mb-0 text-start" dir="ltr">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('users.regist') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control rounded-3" id="nameInput" placeholder="الاسم" value="{{ old('name') }}" required>
                            <label for="nameInput">الاسم بالكامل</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control rounded-3" id="emailInput" placeholder="البريد الإلكتروني" value="{{ old('email') }}" required>
                            <label for="emailInput">البريد الإلكتروني</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control rounded-3" id="passInput" placeholder="كلمة المرور" required>
                            <label for="passInput">كلمة المرور</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="password" name="password_confirmation" class="form-control rounded-3" id="passConfirmInput" placeholder="تأكيد كلمة المرور" required>
                            <label for="passConfirmInput">تأكيد كلمة المرور</label>
                        </div>

                        <button type="submit" class="btn btn-gradient w-100 rounded-pill fw-bold fs-5 py-3 mb-3">إنشاء الحساب 🚀</button>

                        <div class="text-center mt-2">
                            <span class="text-muted">لديك حساب بالفعل؟</span>
                            <a href="{{ route('login') }}" class="text-decoration-none fw-bold text-primary border-bottom pb-1">سجل دخول من هنا</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
