<?php

namespace App\Http\Controllers;

use App\Models\BookMark;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookMarkController extends Controller
{
    public function store(Request $request, Property $property)
    {
        $userId = Auth::id();

        // Check if bookmark exists
        $existing = BookMark::where([
            'property_id' => $property->id,
            'user_id' => $userId
        ])->first();

        if (!$existing) {
            // Add bookmark
            BookMark::create([
                'property_id' => $property->id,
                'user_id' => $userId
            ]);

            return response()->json(['bookmarked' => true]);
        } else {
            // Remove bookmark
            $existing->delete();
            return response()->json(['bookmarked' => false]);
        }
    }
}
