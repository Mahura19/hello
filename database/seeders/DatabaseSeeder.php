<?php

namespace Database\Seeders;

use App\Models\Category;
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
         \App\Models\User::factory(10)->create();
         User::factory()->create([
             "name" => "mahura",
             "email"=> "mahura@gmail.com",
             "password"=> Hash::make("asdffdsa")
         ]);

        $categories = ["IT news","Food & Drinks","Travel","Crypto News"];
        foreach ($categories as $category){
            Category::factory()->create([
                "title" => $category,
                "slug" => Str::slug($category),
                "user_id"=> User::inRandomOrder()->first()->id
            ]);
        }

        Post::factory(250)->create();
    }
}
