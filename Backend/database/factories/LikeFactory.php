<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::factory()->create();
        $blog = Blog::factory()->create(['user_id' => $user->id ]);
        $post =  Post::factory()->create(['blog_id' => $blog->id]);
        return [
            //
            'post_id' => $post->id,
            'blog_id' => $blog->id
        ];
    }
}
