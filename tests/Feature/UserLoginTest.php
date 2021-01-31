<?php

namespace Tests\Feature;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_login(): void
    {
        $user = User::factory()->create(['role' => 1]);

        $credentials = [
            'email' => $user->email,
            'password' => 'password'
        ];

        $response = $this->json('POST', 'api/v1/login', $credentials);

        $response->assertStatus(200)
            ->assertExactJson(((new UserResource($user))->response()->getData('true')));
    }

    /** @test */
    public function user_has_valid_login_credential(): void
    {
        $user = User::factory()->create(['role' => 1]);

        $credentials = [
            'email' => $user->email,
            'password' => 'wrongPassword'
        ];

        $response = $this->json('POST', 'api/v1/login', $credentials);

        $response->assertStatus(422)->assertJsonFragment(['email' => ['The provided credentials are incorrect.']]);
    }

    /** @test */
    public function user_login_validate_input(): void
    {
        $response = $this->json('POST', 'api/v1/login', []);
        $response->assertStatus(422)->assertJsonValidationErrors(['email', 'password']);

        $response = $this->json('POST', 'api/v1/login', ['email' => 'badEmailAddress']);
        $response->assertStatus(422)->assertJsonValidationErrors(['email', 'password']);
    }

    /** @test */
    public function user_logout(): void
    {
        $user = User::factory()->create(['role' => 1]);

        $response = $this->actingAs($user)->json('POST', 'api/v1/logout');
        $response->assertStatus(200);
    }

}
