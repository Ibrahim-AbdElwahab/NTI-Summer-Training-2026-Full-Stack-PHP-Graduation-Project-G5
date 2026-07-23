<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Notification;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $postsCount = Post::count();

        return view('admin.dashboard', compact('usersCount', 'postsCount'));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->with('error', 'لا يمكنك حذف حسابك الشخصي!');
        }

        $user->delete();

        return back()->with('success', 'تم حذف المستخدم بنجاح.');
    }

    public function posts()
    {
        $posts = Post::with('user')->latest()->get();
        return view('admin.posts', compact('posts'));
    }

    public function deletePost($id)
    {
        $post = Post::findOrFail($id);

        Notification::create([
            'user_id' => $post->user_id,
            'message' => 'قام المسؤول بحذف مقالك بعنوان: ' . $post->title,
        ]);

        $post->delete();

        return back()->with('success', 'تم حذف المقال وإرسال إشعار لصاحبه بنجاح.');
    }

    public function notifications()
    {
        $notifications = Notification::where('user_id', auth()->id())->latest()->get();
        return view('admin.notifications', compact('notifications'));
    }
}
