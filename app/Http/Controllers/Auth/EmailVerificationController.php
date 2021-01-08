<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    /**
     * @param $user_id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function verify($user_id, Request $request)
    {
        if (!$request->hasValidSignature()) {
            return response()->json(["msg" => "Invalid/Expired url provided."], 401);
        }

        $user = User::findOrFail($user_id);

        if (! hash_equals((string) $request->route('hash'),
            sha1($user->getEmailForVerification()))) {
            return response()->json(["msg" => "Invalid/Expired url provided."], 401);
        }

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        event(new Verified($user));

        return redirect()->to('/#/login')->with("msg", "Email Verified Successfully");
//        return response()->json(["msg" => "Email Verified Successfully"]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function send() {

        if (auth()->user()->hasVerifiedEmail()) {
            Abort(400, 'Email Already Verified');
        }

        auth()->user()->sendEmailVerificationNotification();

        return response()->json(["msg" => "Email verification link sent to your email"]);
    }
}
