<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Handle a registration request for the application.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return response()->json(new UserResource($user), 201);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255',  Rule::unique(User::class)],
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms_agreement' => ['required', 'boolean', 'accepted'],
            'subscribe' => ['required', 'boolean'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    private function create(array $data): User
    {
        return User::create([
            'email' => $data['email'],
            'name' => $data['name'],
            'password' => Hash::make($data['password']),

            'terms_agreement' => $data['terms_agreement'],
            'terms_agreement_ip' => request()->ip(),
            'terms_agreement_agent' => request()->header('User-Agent'),
            'terms_agreement_date' => now()->format('Y-m-d H:i:s'),

            'subscribe' => $data['subscribe'],
            'subscribe_ip' => $data['subscribe'] ? request()->ip() : null,
            'subscribe_agent' => $data['subscribe'] ? request()->header('User-Agent') : null,
            'subscribe_date' => $data['subscribe'] ? now()->format('Y-m-d H:i:s') : null,
        ]);
    }
}
