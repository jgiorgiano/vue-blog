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


    public function testLoadArticles()
    {
        $admin_user = User::factory()->create(['role' => 1]);
        $not_admin_user = User::factory()->create(['role' => 2]);

        Article::factory()->count(30)->create();
        Article::factory()->count(6)->create(['user_id' => $not_admin_user->id]);

        $response = $this->actingAs($admin_user)->json('GET', 'api/article');
        $response->assertStatus(200)->assertJsonCount(36);

        $response = $this->actingAs($not_admin_user)->json('GET', 'api/article');
        $response->assertStatus(200)->assertJsonCount(6);
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
