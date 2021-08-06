<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [
            array(
                'title' => 'Title one',
            ),
            array(
                'title' => 'Title two',
            ),
            array(
                'title' => 'Title three',
            ),
        ];
        foreach ($posts as $post){
            Post::create([
                'title' => $post['title']
            ]);
        }
    }
}
