<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Gallery;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Hlwan",
            'email' =>"admin@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('11111111'), // password
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => "Moe",
            'email' =>"hma@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('11111111'), // password
            'remember_token' => Str::random(10),
        ]);


        User::factory(20)->create();
        Post::factory(100)->create();
        Gallery::factory(300)->create();
        Comment::factory(500)->create();

    }
}
