<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    // 1. إضافة تعليق جديد على المقال
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        // إضافة التعليق وربطه بالمقال واليوزر اللي عامل Login دلوقتي
        $post->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        return back()->with('success', 'تم إضافة تعليقك بنجاح!');
    }

    // 2. تعديل التعليق
    public function update(Request $request, Comment $comment)
    {
        // حماية: التأكد إن اللي بيعدل التعليق هو صاحب التعليق نفسه مش حد تاني!
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'غير مصرح لك بتعديل هذا التعليق.');
        }

        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment->update([
            'body' => $request->body,
        ]);

        return back()->with('success', 'تم تعديل التعليق بنجاح!');
    }

    // 3. حذف التعليق
    public function destroy(Comment $comment)
    {
        // حماية: التأكد إن اللي بيمسح هو صاحب التعليق (أو يقدر يمسحه لو صاحب المقال لو حبيت تزودها بعدين)
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'غير مصرح لك بحذف هذا التعليق.');
        }

        $comment->delete();

        return back()->with('success', 'تم حذف التعليق بنجاح!');
    }

    // 4. عمل Like أو إلغائه (Toggle Like)
    // بدل ما نطلع للعميل alert إنه عامل لايك قبل كده زي ما عمر كان عامل، نخليها أذكى: لو داس لايك وهو عامل قبل كده، يلغيه، لو مش عامل، يضيفه!
    public function toggleLike(Comment $comment)
    {
        $existingLike = $comment->likes()->where('user_id', auth()->id())->first();

        if ($existingLike) {
            // لو عامل لايك قبل كده، احذفه (Unlike)
            $existingLike->delete();
        } else {
            // لو مش عامل، ضيف لايك جديد
            $comment->likes()->create([
                'user_id' => auth()->id(),
            ]);
        }

        return back();
    }
}
