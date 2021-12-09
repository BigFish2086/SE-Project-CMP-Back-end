<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $blog = Blog::factory()->create();
        return [
            'body' => $this->faker->randomHtml(4, 2),
            'blog_id' => $blog->id
        ];
    }
}
