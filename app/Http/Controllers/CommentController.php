<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        return back()->with('success', 'تم إضافة تعليقك بنجاح!');
    }

    public function update(Request $request, Comment $comment)
    {
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

    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'غير مصرح لك بحذف هذا التعليق.');
        }

        $comment->delete();

        return back()->with('success', 'تم حذف التعليق بنجاح!');
    }

    public function toggleLike(Comment $comment)
    {
        $existingLike = $comment->likes()->where('user_id', auth()->id())->first();

        if ($existingLike) {
            $existingLike->delete();
        } else {
            $comment->likes()->create([
                'user_id' => auth()->id(),
            ]);
        }

        return back();
    }
}
