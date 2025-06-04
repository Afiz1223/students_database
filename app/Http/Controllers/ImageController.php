<?php

namespace App\Http\Controllers;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ImageController extends Controller

{   public function uploadImages(Request $request)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

            $user = $request->user();
            $uploadedImages = [];

        if ($request->hasFile('images'))
        {
            foreach ($request->file('images') as $image)
            {
                $filename = Str::random(10) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('public/images', $filename);

                $uploadedImages[] = [
                    'uid' => Str::uuid(),
                    'url' =>url (Storage::url($path)),
                    'path' => str_replace('public/', '', $path),
                ];
            }

            $user->Images()->createMany($uploadedImages);

            return response()->json([
                'message' => 'Images uploaded successfully',
                'images' => $uploadedImages
            ]);
        }

        return response()->json([
            'message' => 'No images were uploaded'
        ], 400);
    }
    public function userImage(Request $request, $uid)

    {
        $image = $request->user()->images()->where('uid', $uid)->firstOrFail();
    return response()->json(['images' => $image]);
    }

    public function destroyImage(\App\Models\Image $image)
        {
            if ( !$image)

            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Image not found or does not belong to the user',
                    'data' => $image
                ], 404);
            }

            $filePath = 'private/public/images' . basename($image->path);

            if (Storage::disk('local')->exists($image->path))
            {
                Storage::disk('local')->delete($image->path);
            }

            $image->delete();

            return response()->json([
            'status' => 'success',
            'message' => 'Image deleted successfully',

            ]);

        }

        public function getImages(Request $request)
        {

                return Auth::user()->image;

        }

}





