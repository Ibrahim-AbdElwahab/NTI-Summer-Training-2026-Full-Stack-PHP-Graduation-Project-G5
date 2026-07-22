<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول | Blog System</title>
    <!-- Bootstrap 5 RTL CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <!-- Google Fonts (Cairo) -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #111827, #1f2937, #374151);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-custom {
            background: rgba(255, 255, 255, 0.96);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
            border: none;
            overflow: hidden;
        }

        .card-header-custom {
            background: linear-gradient(to right, #111827, #374151);
            color: white;
            padding: 25px 20px;
            text-align: center;
            border-bottom: none;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #ccc;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(31, 41, 55, 0.2);
            border-color: #1f2937;
        }

        .btn-custom {
            background: linear-gradient(to right, #111827, #374151);
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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card card-custom">
                    <div class="card-header-custom">
                        <h3 class="mb-1 fw-bold"> مرحباً بك مجدداً</h3>
                        <p class="mb-0 fs-6 text-light opacity-75">سجل دخولك لمتابعة المقالات</p>
                    </div>
                    <div class="card-body p-4 p-md-5">

                        <!-- رسالة الخطأ لو البيانات غلط -->
                        @if($errors->any())
                        <div class="alert alert-danger text-center fw-semibold py-2 border-0 shadow-sm" style="border-radius: 8px;">
                            ⚠️ {{ $errors->first() }}
                        </div>
                        @endif

                        <form action="{{ route('users.login') }}" method="POST">
                            @csrf

                            <!-- حقل الإيميل -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">البريد الإلكتروني:</label>
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" placeholder="name@example.com" required autofocus>
                            </div>

                            <!-- حقل كلمة المرور -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="password" class="form-label fw-semibold mb-0">كلمة المرور:</label>
                                    <!-- رابط نسيت الباسورد هنظبته بعدين -->
                                    <a href="#" class="text-decoration-none" style="font-size: 0.85rem; color: #374151;">نسيت كلمة المرور؟</a>
                                </div>
                                <input type="password" name="password" id="password"
                                    class="form-control mt-1" placeholder="••••••••" required>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-custom text-white">دخول للنظام</button>
                            </div>
                        </form>

                        <hr class="my-4">

                        <div class="text-center">
                            <span class="text-muted">ليس لديك حساب بعد؟</span>
                            <a href="{{ route('users.regist.view') }}" class="text-decoration-none fw-bold ms-1" style="color: #111827;">أنشئ حساباً الآن</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>