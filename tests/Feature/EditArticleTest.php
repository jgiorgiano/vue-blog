<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditArticleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testEditArticle()
    {
        $article = Article::factory()->create();

        $user = $article->user;

        $edit = [
            'title' => 'Article Title',
            'content' => 'Article Content',
            'tags' => 'Article, tags',
            'images' => null,
        ];

        $response = $this->actingAs($user)->json('PUT', 'api/article/' . $article->id, $edit);

        $response->assertStatus(200)->assertJsonFragment($edit);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testManageArticle()
    {
        $article = Article::factory()->create();

        $user = User::factory()->create(['role' => 1]);

        $edit = [
            'status' => 1,
            'position' => 12,
            'featured' => 1,
        ];

        $response = $this->actingAs($user)->json('PUT', 'api/article/' . $article->id . '/manager', $edit);

        $response->assertStatus(200)->assertJsonFragment($edit);
    }

    public function testEditImageArticle()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testAuthorizationForEditArticle()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testAuthorizationForManagingArticle()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
