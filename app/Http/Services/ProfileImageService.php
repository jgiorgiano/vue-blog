<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileImageService
{
    private $storage_folder;

    public function __construct()
    {
        $this->storage_folder =  'public/profile_images/';
    }

    public function upload($user, Request $request)
    {
        if ($request->hasFile('profile_image')) {

            $extension = $request->profile_image->extension();

            $random_name = Str::random(30);

            $filename = $random_name . '.' . $extension;

            $request->profile_image->storeAs($this->storage_folder, $filename);

            Storage::delete($this->storage_folder . $user->profile_image);

            $user->profile_image = $filename;
        }
    }
}
