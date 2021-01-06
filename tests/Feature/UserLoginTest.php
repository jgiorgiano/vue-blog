<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;

    public function testUserLogin()
    {
        $user = User::factory()->create(['role' => 1]);

        $credentials = [
            'email' => $user->email,
            'password' => 'password'
        ];

        $response = $this->json('POST', 'api/v1/login', $credentials);

        $response->assertStatus(200)->assertJsonFragment(['name' => $user->name, 'email' => $user->email]);
    }
}
