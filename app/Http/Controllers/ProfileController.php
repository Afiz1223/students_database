<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
   public function profile(Request $request)
    {
        if($request->user())
        {
            return response()->json([
                'message' => 'Profile fetched.',
                'data' => $request->user()
            ],200);

        }

       else{

        return response()->json([
            'message' => 'Not Authenticated!',
        ],401);

        }
   }


    public function destroy(User $user)

    {
            if (!$user)
            {
                return response()->json([
                'status' => 'error',
                'message' => 'User not found'
                ], 404);
            }

            $user->delete();


                return response()->json([
                    'message' => 'User deleted successfully'
                ], 200);

    }


}
