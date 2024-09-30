<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('recipes', 'public');

            // Generate the full URL for the image
            $url = asset('storage/' . $path);

            return response()->json(['path' => $path, 'url' => $url], 200);
        }

        return response()->json(['error' => 'No image file uploaded'], 400);
    }
}
