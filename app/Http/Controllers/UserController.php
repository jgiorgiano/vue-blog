<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function User(User $user)
    {
        return response()->json(auth()->user());
    }
}