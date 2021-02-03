<?php

namespace Tests\Feature;

use App\Mail\ResetPassword;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_sends_reset_password_email(): void
    {
        //Create user by email provided
        $user = User::factory()->create();

        Notification::fake();

        //Create reset password
        $response = $this->json('POST', 'api/v1/forgot-password', ['email' => $user->email]);

        //Generate hash and store on database
        $this->assertDatabaseHas('password_resets', ['email' => $user->email]);

        //Return OK
        $response->assertOk();

        //send email once
        Notification::assertSentTo([$user], ResetPasswordNotification::class, 1);
    }

    /** @test */
    public function is_email_valid():void
    {
        //Create reset password
        $response = $this->json('POST', 'api/v1/forgot-password', ['email' => 'not_valid_email.com']);

        $response->assertJsonValidationErrors('email');
    }

    /** @test */
    public function it_resets_the_password_using_token_provided(): void
    {
        //Create user by email provided
        $user = User::factory()->create();
        $password = Str::random(10);

        $token = Password::broker()->createToken($user);

        $request = [
            'email' => $user->email,
            'token' => $token,
            'password' => $password,
            'password_confirmation' => $password,
        ];

        //Create reset password
        $response = $this->json('POST', 'api/v1/reset-password', $request);

        $response->assertOk();

        $user->refresh();

        $this->assertTrue(Hash::check($password, $user->password));

        $this->assertFalse(Hash::check('password', $user->password));
    }

    /** @test */
    public function it_return_error_when_credentials_not_valid(): void
    {
        //Create user by email provided
        $user = User::factory()->create();
        $password = Str::random(10);

        $token = Password::broker()->createToken($user);
        //Invalid Email
        $request = [
            'email' => 'any@email.com',
            'token' => $token,
            'password' => $password,
            'password_confirmation' => $password,
        ];

        //Create reset password
        $response = $this->json('POST', 'api/v1/reset-password', $request);
        $response->assertStatus(400);
        $user->refresh();
        $this->assertFalse(Hash::check($password, $user->password));
        $this->assertTrue(Hash::check('password', $user->password));

        //Invalid Token
        $request = [
            'email' => $user->email,
            'token' => $token . '_invalid',
            'password' => $password,
            'password_confirmation' => $password,
        ];

        //Create reset password
        $response = $this->json('POST', 'api/v1/reset-password', $request);
        $response->assertStatus(400);
        $user->refresh();
        $this->assertFalse(Hash::check($password, $user->password));
        $this->assertTrue(Hash::check('password', $user->password));
    }

    /**
     * @test
     * @dataProvider reset_password_provider
     * @param $request
     */
    public function is_reset_password_request_valid($request, $expected_validation_error):void
    {
        //Create reset password
        $response = $this->json('POST', 'api/v1/reset-password', $request);

        $response->assertJsonValidationErrors($expected_validation_error);
    }


    public function reset_password_provider():array
    {
        return [
            [[ 'email' => '', 'password' => '', 'password_confirmation' => ''], ['email', 'token', 'password']],
            [[ 'email' => 'test', 'token' => '', 'password' => 'short', 'password_confirmation' => 'short'], ['email', 'token', 'password']],
            [[ 'email' => 'email', 'password' => 'password', 'password_confirmation' => 'wpassword'], ['email', 'token', 'password']],
            [[ 'email' => 'email@email.com',  'password' => 'password', 'password_confirmation' => 'wpassword'], ['token', 'password']],
            [[ 'email' => 'email@email.com',  'password' => 'password', 'password_confirmation' => 'password'], ['token']],
        ];

    }




}
