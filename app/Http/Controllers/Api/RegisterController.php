<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class RegisterController extends Controller
{
    public function Register(Request $request):JsonResponse

    {
     $request -> validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'last_name'=> 'required|string|max:255',
            'phone_no'=> 'required|string|max:20',
            'address' => 'required|string|max:255',
            'email'=> 'required|email|unique:users,email|max:25',
            'password' => 'required|string|min:5|max:25|confirmed'
            ]);

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_no' => $request->phone_no,
                'address' => $request->address,
                'email' => $request->email,
                'password' => Hash::make($request->password),
              ]);


             if($user)

            {
                $token = $user->createToken ($user->name.'Auth-Token')->plainTextToken;

                return response()->json([
                    'message' => 'Registered Successfully!',
                    'token_type' => 'bearer',
                    'token' => $token

                 ],201);
            }

            else
            {
                return response()->json([
                 'message' => 'Something went wrong during registration!!',

                ],500);

            }
     }
}
