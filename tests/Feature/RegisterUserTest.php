<?php

namespace Tests\Feature;

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
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $response = $this->json('POST','api/register', $user);

        $response->assertStatus(201);
    }
}
