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
        $admin_user = User::factory()->create(['role' => 3]);
        $not_admin_user = User::factory()->create(['role' => 2]);

        Article::factory()->count(30)->create();
        Article::factory()->count(6)->create(['user_id' => $not_admin_user->id]);

        $response = $this->actingAs($admin_user)->json('GET', 'api/v1/article');
        $response->assertStatus(200)->assertJsonCount(36);

        $response = $this->actingAs($not_admin_user)->json('GET', 'api/v1/article');
        $response->assertStatus(200)->assertJsonCount(6);
    }

    public function testLoadArticle()
    {
        $article = Article::factory()->count(30)->create();

        $user = $article[10]->user;

        $response = $this->actingAs($user)->json('GET', 'api/v1/article/' . $article[10]->id);

        $response->assertStatus(200)->assertJsonFragment(
            [
                'title' => $article[10]->title,
                'content' => $article[10]->content,
                'tags' => $article[10]->tags
            ]
        );
    }

    public function testLoadPublishedArticlesWithPagination()
    {
        $published_articles = 15;

        Article::factory()->count(20)->create(['status' => 0]);
        Article::factory()->count($published_articles)->create(['status' => 1]); //Published Articles
        Article::factory()->count(5)->create(['status' => 2]);
        Article::factory()->count(15)->create(['status' => 3]);

        //Options take and page

        $response = $this->json('GET', 'api/v1/article/published');

        $response->assertStatus(200)->assertJsonFragment(['total'=> $published_articles]);

        $response = $this->json('GET', 'api/v1/article/published?take=3');

        $response->assertStatus(200)->assertJsonFragment(['total'=> $published_articles])->assertJsonFragment(['per_page'=> "3"]);
    }

    public function testLoadFeaturedArticles()
    {
        Article::factory()->count(20)->create(['status' => 0, 'featured' => 1]);
        Article::factory()->count(15)->create(['status' => 1, 'featured' => 0]); //Published Articles
        Article::factory()->count(5)->create(['status' => 2, 'featured' => 1]);
        Article::factory()->count(15)->create(['status' => 3]);

        $featured_articles = Article::factory()->count(15)->create(['status' => 1, 'featured' => 1]); //Published And Featured Articles

        $response = $this->json('GET', 'api/v1/article/featured');

        $response->assertStatus(200)->assertJsonCount($featured_articles->count());
    }

    public function testDeleteArticle()
    {
        $article = Article::factory()->create();

        $user = $article->user;

        $response = $this->actingAs($user)->json('DELETE', 'api/v1/article/' . $article->id);

        $response->assertStatus(204);
    }


}
