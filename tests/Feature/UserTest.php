<?php

namespace Tests\Feature;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function get_own_user_details(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->json('GET', 'api/v1/user');

        $response->assertStatus(200)
            ->assertExactJson(((new UserResource($user))->response()->getData('true')));
    }

    /** @test */
    public function user_can_update_its_details(): void
    {
        $user = User::factory()->create(['role' => 1]);

        $data_to_update = [
            'name' => 'new name',
            'subscribe' => 0
        ];

        $response = $this->actingAs($user)->json('POST', 'api/v1/user', $data_to_update);

        $response->assertStatus(200)->assertJsonFragment($data_to_update);
    }

    /** @test */
    public function user_valid_update_details(): void
    {
        $user = User::factory()->create(['role' => 1]);

        $response = $this->actingAs($user)->json('POST', 'api/v1/user', []);
        $response->assertStatus(422)->assertJsonValidationErrors(['name']);

        $response = $this->actingAs($user)->json('POST', 'api/v1/user', ['name' => '', 'subscribe' => 'not_valid']);
        $response->assertStatus(422)->assertJsonValidationErrors(['name', 'subscribe']);
    }


}
