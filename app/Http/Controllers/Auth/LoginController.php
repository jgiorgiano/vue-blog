<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Handle an authentication attempt.
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable
     * @throws ValidationException
     */
    public function authenticate(Request $request)
    {
        $this->validateLogin($request);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return Auth::user();
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);

    }
}
