<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function register_new_user(): void
    {
        $user = [
            'name' => 'John Doe',
            'email' => 'jd@gmail.com',
            'subscribe' => 0,
            'terms_agreement' => 1,
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $response = $this->json('POST', 'api/v1/register', $user);

        unset($user['password'], $user['password_confirmation']);

        $response->assertStatus(201)->assertJsonFragment($user);
    }

    /** @test */
    public function register_has_required_inputs(): void
    {
        $response = $this->json('POST', 'api/v1/register', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email', 'name', 'password', 'subscribe', 'terms_agreement']);
    }

}
