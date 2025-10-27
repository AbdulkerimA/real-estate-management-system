<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MediaController extends Controller
{
    public function update(Request $request)
    {

        // return response()->json(dd($request->all()));

        // if ($request->hasFile('profilePic')) {
        //     $file = $request->file('profilePic')->store('test', 'public');
        //     return response()->json(['ok' => true, 'path' => $file]);
        // }
        // return response()->json(['error' => 'no file'], 400);

        $request->validate([
            'profilePic' => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        if (!$request->hasFile('profilePic')) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }

        $file = $request->file('profilePic')->store('profiles', 'public');
        $mime = $request->file('profilePic')->getClientMimeType();

        $user = Auth::user();
        $mediaId = $user->agentProfile->media->id;
        
        if (!$mediaId) {
            return response()->json(['error' => 'Media record not found'], 404);
        }

        Media::where('id', $mediaId)->update([
            'file_path' => $file,
            'file_type' => $mime,
        ]);

        return response()->json(['success' => 'Profile successfully updated']);
    }
}
