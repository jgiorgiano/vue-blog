<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(1)->create(['email' => '1@test.com', 'role' => 1, 'profile_image' => 'img/user-placeholder2.png']);
         \App\Models\User::factory(10)->create(['role' => 1, 'profile_image' => 'img/user-placeholder2.png']);
    }
}
