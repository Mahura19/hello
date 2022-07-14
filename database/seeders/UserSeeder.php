<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        User::factory()->create([
            "name" => "mahura",
            "role" => "admin",
            "email"=> "mahura@gmail.com",
            "password"=> Hash::make("asdffdsa")
        ]);

        User::factory()->create([
            "name" => "Test Admin",
            "role" => "admin",
            "email"=> "admin@gmail.com",
            "password"=> Hash::make("asdffdsa")
        ]);

        User::factory()->create([
            "name" => "Test Editor",
            "role" => "editor",
            "email"=> "editor@gmail.com",
            "password"=> Hash::make("asdffdsa")
        ]);

        User::factory()->create([
            "name" => "Test Author",
            "role" => "author",
            "email"=> "author@gmail.com",
            "password"=> Hash::make("asdffdsa")
        ]);
    }
}
