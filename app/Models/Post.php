<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function comments()
    {
        return $this->hasMany(Comment::class)->latest(); // عشان يجيب الأحدث الأول
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
