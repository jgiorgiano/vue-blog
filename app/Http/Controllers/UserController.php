<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function User()
    {
        return response()->json(auth()->user());
    }

    public function update(UserUpdateRequest $request)
    {
//        dd(storage_path('profile_images'));

        $user = Auth::user();

        $user->name = $request->input('name');

//        @todo create logger for subscribe
        $user->subscribe = $request->input('subscribe');

        //@todo create better solution
        if ($request->hasFile('profile_image')) {

            $extension = $request->profile_image->extension();

            $random_name = Str::random(30);

            $filename = $random_name . '.' .$extension;

            $request->profile_image->storeAs('public/profile_images', $filename);

            $user->profile_image = $filename;
        }

        $user->save();

        return response()->json($user);
    }
}
