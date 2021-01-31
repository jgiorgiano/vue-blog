<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class EditArticleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function edit_article()
    {
        $article = Article::factory()->create();

        $user = $article->user;

        $edit = [
            'title' => 'Article Title',
            'description' => 'Article Description',
            'content' => 'Article Content Article Content Article Content Article Content Article Content Article Content Article Content Article Content Article Content Article Content Article Content Article Content Article Content Article Content',
            'tags' => 'Article, tags',
            'featured' => 1,
            'position' => 2,
            'status' => 2,
            'type' => 1,
            'external_link' => 'https://testing.com.br/article',
            'images' => null,
        ];

        $response = $this->actingAs($user)->json('PUT', 'api/v1/article/' . $article->id, $edit);

        $response->assertStatus(200)->assertJsonFragment($edit);
    }

    /**
     * @test
     */
    public function only_owner_or_admin_can_edit_article()
    {
        $article = Article::factory()->create();

        $owner_user = $article->user;
        $admin_user = User::factory()->create(['role' => 3]);
        $non_admin_user = User::factory()->create(['role' => 2]);

        $edit = [
            'title' => 'Article Title',
            'description' => 'Article Description',
            'content' => 'Article Content Article Content Article Content Article Content Article Content Article Content Article Content Article Content Article Content Article Content Article Content Article Content Article Content Article Content',
            'tags' => 'Article, tags',
            'featured' => 1,
            'position' => 2,
            'status' => 2,
            'type' => 1,
            'external_link' => 'https://testing.com.br/article',
            'images' => null,
        ];

        $response = $this->actingAs($owner_user)->json('PUT', 'api/v1/article/' . $article->id, $edit);
        $response->assertStatus(200)->assertJsonFragment($edit);

        $response = $this->actingAs($admin_user)->json('PUT', 'api/v1/article/' . $article->id, $edit);
        $response->assertStatus(200)->assertJsonFragment($edit);

        $response = $this->actingAs($non_admin_user)->json('PUT', 'api/v1/article/' . $article->id, $edit);
        $response->assertStatus(403);
    }

    /**
     * @test
     * @dataProvider required_update_article_validation_provider
     * @param $put_data
     * @param $expected_validation_error
     */
    public function validation_input_update_article($put_data, $expected_validation_error): void
    {
        $user = User::factory()->create();
        $article = Article::factory()->create(['user_id' => $user->id ]);

        $response = $this->actingAs($user)->json('PUT', 'api/v1/article/' . $article->id, $put_data);
        $response->assertStatus(422)->assertJsonValidationErrors($expected_validation_error);
    }

    /**
     * @return array
     */
    public function required_update_article_validation_provider(): array
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

    /**
     * @test
     * @return void
     */
    public function manage_article(): void
    {
        $article = Article::factory()->create();

        $user = User::factory()->create(['role' => 3]);

        $edit = [
            'status' => 1,
            'position' => 12,
            'featured' => 1,
        ];

        $response = $this->actingAs($user)->json('PUT', 'api/v1/article/' . $article->id . '/manager', $edit);

        $response->assertStatus(200)->assertJsonFragment($edit);
    }

    /**
     * @test
     * @return void
     */
    public function only_admin_to_manage_article(): void
    {
        $article = Article::factory()->create();

        $user = User::factory()->create(['role' => 1]); //Not Admin

        $edit = [
            'status' => 1,
            'position' => 12,
            'featured' => 1,
        ];

        $response = $this->actingAs($user)->json('PUT', 'api/v1/article/' . $article->id . '/manager', $edit);

        $response->assertStatus(403);
    }
}
