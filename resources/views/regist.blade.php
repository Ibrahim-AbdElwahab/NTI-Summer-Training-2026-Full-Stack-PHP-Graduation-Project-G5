<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب جديد | Blog System</title>
    <!-- Bootstrap 5 RTL CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <!-- Google Fonts (Cairo) -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }

        .card-custom {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            border: none;
            overflow: hidden;
        }

        .card-header-custom {
            background: #2575fc;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            padding: 20px;
            text-align: center;
            border-bottom: none;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(37, 117, 252, 0.2);
            border-color: #2575fc;
        }

        .btn-custom {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            opacity: 0.9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 117, 252, 0.4);
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card card-custom">
                    <div class="card-header-custom">
                        <h3 class="mb-0 fw-bold"> انضم إلينا</h3>
                        <p class="mb-0 fs-6 opacity-75">أنشئ حسابك الجديد في ثوانٍ</p>
                    </div>
                    <div class="card-body p-4 p-md-5">

                        <form action="{{ route('users.regist') }}" method="POST">
                            @csrf

                            <!-- حقل الاسم -->
                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">الاسم الكامل:</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" placeholder="مثال: إبراهيم عبد الوهاب" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- حقل الإيميل -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">البريد الإلكتروني:</label>
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" placeholder="name@example.com" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- حقل كلمة المرور -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">كلمة المرور:</label>
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="8 أحرف على الأقل" required>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- حقل تأكيد كلمة المرور -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label fw-semibold">تأكيد كلمة المرور:</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" placeholder="أعد كتابة كلمة المرور" required>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-custom text-white">إنشاء الحساب الآن</button>
                            </div>
                        </form>

                        <hr class="my-4">

                        <div class="text-center">
                            <span class="text-muted">لديك حساب بالفعل؟</span>
                            <a href="{{ route('users.login.view') }}" class="text-decoration-none fw-bold ms-1" style="color: #6a11cb;">سجل الدخول</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>