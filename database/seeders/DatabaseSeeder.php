<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(10)->create();
        $first_user = $users->first();
        $first_user->name = 'Admin';
        $first_user->email = 'admin@mydomain.com';
        $first_user->password = Hash::make('admin');
        $first_user->role_name = 'super_admin';
        $first_user->save();

        $categories = Category::factory(25)->create();

        $posts = Post::factory(100)->make()->each(function ($post) use ($users, $categories) {
            $post->user_id = $users->random()->id;
            $post->category_id = $categories->random()->id;
            $post->save();
        });

        $tags = Tag::factory(100)->create();
        $posts->each(function ($post) use ($tags) {
            $post->tags()->attach($tags->random(rand(5, 10))->pluck('id'));
        });

        Comment::factory(50)->make()->each(function ($comment) use ($users) {
            $comment->user_id = $users->random()->id;
            $comment->save();
        });
    }
}
