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
        $user = User::factory()->create();

        $credentials = [
            'email' => $user->email,
            'password' => 'password'
        ];

        $response = $this->json('POST', '/login', $credentials);

        $response->assertStatus(200);
    }
}
