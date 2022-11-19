<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $random_class = fake()->randomElement([Post::class, Category::class, Tag::class]);
        return [
            'body' => fake()->realText(fake()->numberBetween(100, 400)),
            'commentable_id' => $random_class::factory(),
            'commentable_type' => $random_class,
            'user_id' => null,
        ];
    }
}
