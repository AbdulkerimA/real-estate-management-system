<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user()->load([
            'settings',
            'customer.media'
        ]);

        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        // return response()->json(['postlog'=>$request->all()]); // for debuging only
        $user = Auth::user();

        $data = $request->validate([
            'name' => 'required|string|min:2',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required|string',
        ]);

        $user->update($data);

        $user->customer()->updateOrCreate(
            ['user_id' => $user->id],
            ['address' => $data['address']]
        );

        return response()->json(['message' => 'Profile updated']);
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'Current password is incorrect'
            ], 422);
        }

        $user->update([
            'password' => $request->new_password
        ]);

        return response()->json([
            'message' => 'Password updated successfully'
        ]);
    }


}
