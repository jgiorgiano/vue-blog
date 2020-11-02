<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRegisterNewUser()
    {
        $user = [
            'name' => 'John Doe',
            'email' => 'jd@gmail.com',
            'subscribe' => 1,
            'terms_agreement' => 1,
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $response = $this->json('POST', 'api/register', $user);

        unset($user['password']);
        unset($user['password_confirmation']);

        $response->assertStatus(201)->assertJsonFragment($user);

    }
}
