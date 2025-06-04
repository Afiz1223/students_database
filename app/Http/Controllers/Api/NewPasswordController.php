<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
class NewPasswordController extends Controller
{
    public function forgotPassword(Request $request)
    {
          $request->validate([
          'email' => 'required|email',
       ]);

       $status = Password::SendResetLink(
        $request->only('email')
       );

       if($status == Password::RESET_LINK_SENT) {
        return [
            'status' => __($status)
        ];

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
       }
    }


}
