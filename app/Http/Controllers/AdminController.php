<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Notification;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // 1. عرض الصفحة الرئيسية للأدمن (الإحصائيات)
    public function index()
    {
        $usersCount = User::count();
        $postsCount = Post::count();

        return view('admin.dashboard', compact('usersCount', 'postsCount'));
    }

    // 2. عرض كل المستخدمين
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    // 3. حذف مستخدم (بعد إزالة ثغرة الإشعار الميت)
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        // حماية: الأدمن ميقدرش يمسح نفسه
        if ($user->id === auth()->id()) {
            return back()->with('error', 'لا يمكنك حذف حسابك الشخصي!');
        }

        // تم إزالة إنشاء الإشعار هنا، لأن حذف اليوزر هيمسح الإشعار أوتوماتيك بالـ Cascade!
        $user->delete();

        return back()->with('success', 'تم حذف المستخدم بنجاح.');
    }

    // 4. عرض كل المقالات
    public function posts()
    {
        $posts = Post::with('user')->latest()->get();
        return view('admin.posts', compact('posts'));
    }

    // 5. حذف مقال وإرسال إشعار لصاحبه
    public function deletePost($id)
    {
        $post = Post::findOrFail($id);

        // إرسال إشعار لصاحب المقال قبل ما نمسح المقال
        Notification::create([
            'user_id' => $post->user_id,
            'message' => 'قام المسؤول بحذف مقالك بعنوان: ' . $post->title,
        ]);

        $post->delete();

        return back()->with('success', 'تم حذف المقال وإرسال إشعار لصاحبه بنجاح.');
    }

    // 6. عرض إشعارات المستخدم الحالي
    public function notifications()
    {
        $notifications = Notification::where('user_id', auth()->id())->latest()->get();
        return view('admin.notifications', compact('notifications'));
    }
}
