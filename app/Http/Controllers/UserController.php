<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Http\Services\LoggingService;
use App\Http\Services\ProfileImageService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function user()
    {
        $user = Auth::user();

        return response()->json($user);
    }

    public function update(UserUpdateRequest $request, ProfileImageService $profileImageService)
    {
        $user = Auth::user();

        $user->name = $request->input('name');

        $user->subscribe = $request->input('subscribe');

        $profileImageService->upload($user, $request);

        $user->save();

        return response()->json($user);
    }
}
