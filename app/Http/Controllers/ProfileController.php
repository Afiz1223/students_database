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
 
            //  $user = User::where('id', $id)->exists();
            
            

            if (! $user) {
                return response()->json([
                'status' => 'error',
                'message' => 'User not found'
                ], 404);
            }

            $user->delete();

            
                return response()->json([
                    'message' => 'User deleted successfully'
                ], 200);
            
            // else
            //     {
            //         return response()->json([
            //         'status' => 'error',
            //         'message' => 'User not found'
            //         ], 404);
            //     }





        // try{
        
        //     $user = User::find($id);
           
            // return response()->json(data:array('status' =>'success', 'message' => 'user deleted successfully'),
            //  status:200);

        //     if (!$user) {
        //     return response()->json([
        //     'status' => 'error',
        //     'message' => 'User not found'
        //     ], 404);
        //      }

        //      $user->delete(); // Now safe to delete

        //     return response()->json([
        //         'message' => 'User deleted successfully'
        //     ], 200);
        //             }catch( \Exception $e) {
        //         return response()->json(data:array ('status' => 'error', 
        //         'message' => 'User not found or could not be deleted', 'error' => $e->getMessage() ),
        //         status: 500);
        //     }
       
        
    // }

    // public function destroy(Request $request)
    //     {
    //     try {
    //         $user = $request->user(); // Gets the authenticated user

    //         // Optional: Add password confirmation for security
    //         if (!Hash::check($request->input('password'), $user->password)) {
    //             return response()->json([
    //                 'status' => 'error',
    //                 'message' => 'Password incorrect'
    //             ], 403);
    //         }

    //         $user->delete(); // or $user->forceDelete();

    //         // Optional: Revoke tokens (if using Sanctum/Passport)
    //         // $user->tokens()->delete();

    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Your account has been deleted'
    //         ], 200);

    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Account deletion failed',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    }

    
}
