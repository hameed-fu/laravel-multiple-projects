<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Post::all() as $key => $post) {
            Comment::create([
                'comment'   => "Hello comment",
                'post_id'   => $post->id,
            ]);
        }
    }
}
