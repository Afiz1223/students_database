<?php

namespace App\Http\Controllers\api;
use Carbon\Cli\Invoker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
// use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed',],
            // 'RulesPassword'::defaults()
        ]);

        $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function($user) use ($request) {
            $user->forceFill([

            "password" => Hash::make($request->password),
            "remember_token" => Str::random(60),
            ])->save();

            event(new PasswordReset($user));
        }
        );

        if($status == Password::PASSWORD_RESET) {
            return response([
                'message' => 'password reset successfully!'
            ]);
        }

        return response([
            'message' => __($status)
        ], 500);
    }
}
