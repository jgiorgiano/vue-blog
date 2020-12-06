<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateArticleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateNewArticle()
    {
        $user = User::factory()->create();

        $new_article = [
            'title' => 'Article Title',
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
            /*Featured -> 0 | 1 */
            'type' => 1,
            /* type 1 - article | 2 - external link */
            'external_link' => 'https://testing.com.br/article',
            'images' => null,

//            'user_id' => '',
//            'created_at' => 'password',
//            'updated_at' => 'password',
        ];

        $response = $this->actingAs($user)->json('POST', 'api/article', $new_article);

        $response->assertStatus(201)->assertJsonFragment($new_article);
    }

    public function testUploadImagesOnCreateArticle()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testAuthorizationForCreateArticle()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
