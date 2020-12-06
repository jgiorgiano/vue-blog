<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->paragraph(1),
            'description' =>  $this->faker->text(rand(100, 200)),
            'content' =>  $this->faker->text(rand(1000, 10000)),
            'tags' => 'test1, test2, test3, test4, test5',
            'status' => rand(0,3),
            'position' => $this->faker->numberBetween(0,200),
            'featured' => rand(0,1),
            'type' => rand(1,2),
            'external_link' => $this->faker->text(rand(100, 200)),
            'images' => null,
        ];
    }
}
