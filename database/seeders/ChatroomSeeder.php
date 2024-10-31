<?php

namespace Database\Seeders;

use App\Models\Chatroom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ChatroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            Chatroom::create([
                'name' => $faker->name,
                'max_members' => $faker->numberBetween(2, 10),
            ]);
        }
    }
}
