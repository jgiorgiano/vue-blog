<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;


    public function testLoadAllArticles()
    {
        $articles = Article::factory()->count(30)->create();
        $user = User::factory()->create(['role' => 1]);

        $response = $this->actingAs($user)->json('GET', 'api/article');

        $response->assertStatus(200)->assertJsonCount(30);
    }

    public function testLoadArticle()
    {
        $article = Article::factory()->count(30)->create();

        $user = $article[10]->user;

        $response = $this->actingAs($user)->json('GET', 'api/article/' . $article[10]->id);

        $response->assertStatus(200)->assertJsonFragment(
            [
                'title' => $article[10]->title,
                'content' => $article[10]->content,
                'tags' => $article[10]->tags
            ]
        );
    }

    public function testDeleteArticle()
    {
        $article = Article::factory()->create();

        $user = $article->user;

        $response = $this->actingAs($user)->json('DELETE', 'api/article/' . $article->id);

        $response->assertStatus(204);
    }


}
