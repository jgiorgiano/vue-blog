<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateArticleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function create_new_article(): void
    {
        $user = User::factory()->create();

        $new_article = [
            'title' => 'Article Title Article Title Article Title Article Title',
            'description' => 'Article Description',
            'content' => 'Article Content Article Content Article Content Article Content Article Content Article Content Article Content Article Content Article Content Article Content Article Content Article Content Article Content Article Content',
            'tags' => 'Article, tags',
            'status' => 0,
            /* {status: 0, description: 'Waiting Approval'},
               {status: 1, description: 'Published'},
               {status: 2, description: 'Not Published'},
               {status: 3, description: 'Waiting amendment'}*/
            'position' => 0,
            'featured' => 0,
            'type' => 1,
            /* type 1 - article | 2 - external link */
            'external_link' => 'https://testing.com.br/article',
            'images' => null,
        ];

        $response = $this->actingAs($user)->json('POST', 'api/v1/article', $new_article);

        $response->assertStatus(201)->assertJsonFragment($new_article);
    }

    /**
     * @test
     * @dataProvider required_store_article_validation_provider
     */
    public function validation_input_create_article($post_data, $expected_validation_error): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->json('POST', 'api/v1/article', $post_data);
        $response->assertStatus(422)->assertJsonValidationErrors($expected_validation_error);
    }

    /**
     * @return array
     */
    public function required_store_article_validation_provider(): array
    {
        return [
            [[], ['title', 'description', 'type', 'tags']],
            [['type' => 1], ['title', 'description', 'tags', 'content']],
            [['type' => 2], ['title', 'description', 'tags', 'external_link']],
            [['title' => 'short'], ['title']],
            [['title' => Str::random(151)], ['title']],
            [['description' => Str::random(201)], ['description']],
            [['external_link' => Str::random(256)], ['external_link']],
            [['tags' => Str::random(101)], ['tags']],
            [['tags' => Str::random(2)], ['tags']],
            [['type' => 'not Int'], ['type']],
        ];
    }
}
