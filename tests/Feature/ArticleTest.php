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

    /** @test */
    public function admin_load_all_articles(): void
    {
        $admin_user = User::factory()->create(['role' => 3]);
        $not_admin_user = User::factory()->create(['role' => 2]);

        Article::factory()->count(30)->create();
        Article::factory()->count(6)->create(['user_id' => $not_admin_user->id]);

        $response = $this->actingAs($admin_user)->json('GET', 'api/v1/article');
        $response->assertStatus(200)->assertJsonCount(36);
    }

    /** @test */
    public function user_load_only_its_articles(): void
    {
        $not_admin_user = User::factory()->create(['role' => 2]);

        Article::factory()->count(30)->create();
        Article::factory()->count(6)->create(['user_id' => $not_admin_user->id]);

        $response = $this->actingAs($not_admin_user)->json('GET', 'api/v1/article');
        $response->assertStatus(200)->assertJsonCount(6);
    }


    /** @test */
    public function load_articles(): void
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

    /** @test */
    public function load_published_articles_with_pagination(): void
    {
        $published_articles = 15;
        $articles_to_take = "3";

        Article::factory()->count(20)->create(['status' => 0]);
        Article::factory()->count($published_articles)->create(['status' => 1]); //Published Articles
        Article::factory()->count(5)->create(['status' => 2]);
        Article::factory()->count(15)->create(['status' => 3]);

        //Options take and page
        $response = $this->json('GET', 'api/v1/article/published');

        $response->assertStatus(200)->assertJsonFragment(['total' => $published_articles]);

        $response = $this->json('GET', 'api/v1/article/published?take=' . $articles_to_take);

        $response->assertStatus(200)->assertJsonFragment(['total' => $published_articles])->assertJsonFragment(['per_page' => $articles_to_take]);
    }

    /** @test */
    public function load_featured_articles(): void
    {
        Article::factory()->count(20)->create(['status' => 0, 'featured' => 1]);
        Article::factory()->count(15)->create(['status' => 1, 'featured' => 0]); //Published Articles NOT Features
        Article::factory()->count(5)->create(['status' => 2, 'featured' => 1]);
        Article::factory()->count(15)->create(['status' => 3]);

        $featured_articles = Article::factory()->count(15)->create(['status' => 1, 'featured' => 1]); //Published And Featured Articles

        $response = $this->json('GET', 'api/v1/article/featured');

        $response->assertStatus(200)->assertJsonCount($featured_articles->count());
    }

    /** @test */
    public function delete_article(): void
    {
        $article = Article::factory()->create();
        $article2 = Article::factory()->create();

        $owner_user = $article->user;
        $admin_user = User::factory()->create(['role' => 3]);
        $non_admin_user = User::factory()->create(['role' => 2]);

        $response = $this->actingAs($non_admin_user)->json('DELETE', 'api/v1/article/' . $article->id);
        $response->assertStatus(403);

        $response = $this->actingAs($owner_user)->json('DELETE', 'api/v1/article/' . $article->id);
        $response->assertStatus(204);

        $response = $this->actingAs($admin_user)->json('DELETE', 'api/v1/article/' . $article2->id);
        $response->assertStatus(204);
    }
}
