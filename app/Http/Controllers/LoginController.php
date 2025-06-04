<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{

    public function login(Request $request):JsonResponse

    {

        $request->validate([
            // 'slug' => 'required|string',
            'email'=> 'required|email|max:25',
            'password' => 'required|string|min:5|max:25'
        ]);

        $user = User::where('email',$request->email)->first();


        if(!$user || !Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        
        {
            return response()->json([
                'message' => 'incorrect email or password'
            ],401);
        }

        $token = $user->createToken ($user->name.'Auth-Token')->plainTextToken;

        return response()->json([
            'message' => 'Login Successfully!!!',
            'token_type' => 'bearer',
            'token' => $token

        ],200);
    }

    public function logout(Request $request): JsonResponse
        {

            $request->user()->currentAccessToken()->delete();
            {
            return response()->json([
                'message' => 'User Logout Successfully!'
            ], 200);

            }
        }

}
