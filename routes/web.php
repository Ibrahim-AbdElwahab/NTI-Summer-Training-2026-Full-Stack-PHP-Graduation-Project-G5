<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;

// 1. الصفحة الرئيسية: لو زائر جديد وديه للوجن أول حاجة، لو مسجل دخول وديه للمقالات
Route::get('/', function () {
    return auth()->check() ? redirect()->route('posts.index') : redirect()->route('users.login.view');
});

// 2. مسار سحري سريع لعمل Logout من الرابط مباشرة (عشان تفضي متصفحك من السيشن المعلقة)
Route::get('/reset-session', function () {
    auth()->logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect()->route('users.login.view');
});

Route::middleware('guest')->group(function () {
    // Register Routes
    Route::get('/regist', [UserController::class, 'store'])->name('users.regist.view');
    Route::post('/regist', [UserController::class, 'Register'])->name('users.regist');

    // Login Routes
    Route::get('/login', [UserController::class, 'showLogin'])->name('users.login.view');
    Route::post('/login', [UserController::class, 'login'])->name('users.login');
});

Route::middleware('auth')->group(function () {
    // Logout Route
    Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');

    // Posts Routes (هنحميها عشان محدش يضيف بوست وهو مش مسجل)
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'store'])->name('post.create.view');
    Route::post('/posts/create', [PostController::class, 'create'])->name('post.create');
    Route::get('/posts/update/{post}', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/posts/update/{post}', [PostController::class, 'update'])->name('posts.update');
});

// ==========================================
// Comments & Likes Routes (مسارات التعليقات والإعجابات)
// ==========================================
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
Route::post('/comments/{comment}/like', [CommentController::class, 'toggleLike'])->name('comments.like');

// 1. مسار الإشعارات (لأي يوزر مسجل دخول عادي أو أدمن)
Route::middleware('auth')->group(function () {
    // ... مساراتك القديمة بتاعة البوستات والتعليقات ...

    Route::get('/notifications', [AdminController::class, 'notifications'])->name('notifications');
});


// 2. مسارات لوحة تحكم الأدمن (محمية بـ auth و admin مع بعض)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/admin/posts', [AdminController::class, 'posts'])->name('admin.posts');
    Route::delete('/admin/posts/{id}', [AdminController::class, 'deletePost'])->name('admin.posts.delete');
});
