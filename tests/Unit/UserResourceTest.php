<?php

namespace Tests\Unit;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class UserResourceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_resource_has_expected_attributes(): void
    {
        $expected_attributes = [
            'id' => 0,
            'name' => 'User name',
            'email' => 'user@email.com.br',
            'role' => 0,
            'subscribe' => 0,
            'subscribe_date' => null,
            'profile_image_path' => null,
            'created_at' => null,
            'terms_agreement' => 0,
        ];

        $new_user = [
            'name' => 'User name',
            'email' => 'user@email.com.br',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];

        $user = new User($new_user);

        $userResource = new UserResource($user);
        $request  = Request::create('/api/v1/user');

        self::assertEquals($expected_attributes, $userResource->toArray($request));
    }
}
