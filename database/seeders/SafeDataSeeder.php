<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class SafeDataSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::factory(5)->create();

        foreach ($users as $user) {
            $posts = Post::factory(2)->create(['user_id' => $user->id]);

            foreach ($posts as $post) {
                $comments = Comment::factory(3)->create([
                    'post_id' => $post->id,
                    'user_id' => User::inRandomOrder()->first()->id,
                ]);

                foreach ($comments as $comment) {
                    try {
                        DB::table('likes')->insertOrIgnore([
                            'user_id' => User::inRandomOrder()->first()->id,
                            'comment_id' => $comment->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    } catch (\Exception $e) {
                    }
                }
            }
        }
    }
}
