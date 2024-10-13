<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Classroom;
use App\Models\Comment;
use App\Models\Phone;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call([
        //     ClassroomSeeder::class,
        //     SubjectSeeder::class,
        //     StudentSeeder::class,
        //     PassportSeeder::class
        // ]);

        // for ($i = 0; $i < 10; $i++) {
        //     Role::create([
        //         'name' => fake()->text(20),
        //     ]);
        // }

        // for ($i = 0; $i < 10; $i++) {
        //     Post::create([
        //         'title' => fake()->text(100),
        //     ]);
        // }

        // for ($i = 1; $i < 11; $i++) {
        //     Comment::create([
        //         'post_id' => $i,
        //         'content' => fake()->text(),
        //     ]);
        //     Comment::create([
        //         'post_id' => $i,
        //         'content' => fake()->text(),
        //     ]);
        //     Comment::create([
        //         'post_id' => $i,
        //         'content' => fake()->text(),
        //     ]);
        // }

        // Fake data Phone. Bao nhieu user co bay nhieu sdt
        // $usersIDs = User::pluck('id')->all();

        // foreach ($usersIDs as $userID) {

        //     Phone::query()->create([
        //         'user_id' => $userID,
        //         'value' => fake()->unique()->phoneNumber(),
        //     ]);
        // }

        // \App\Models\User::factory(100)->create();

        // $this->call(FlightSeeder::class);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
