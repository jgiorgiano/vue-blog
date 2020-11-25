<?php

namespace Database\Seeders;

use App\Models\Article;
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

         \App\Models\User::factory(1)->create(['email' => '1@test.com', 'role' => 3]);
         \App\Models\User::factory(10)->create(['role' => 1]);
         Article::factory(50)->create();
    }
}
