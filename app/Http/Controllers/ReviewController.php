<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
     /**
     * Store a new agent review.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'agent_id' => 'required|exists:agents,id',
            'rating'   => 'required|integer|min:1|max:5',
            'comment'  => 'nullable|string|max:1000',
        ]);

        Review::create([
            'user_id'  => Auth::id(),
            'agent_id' => $validated['agent_id'],
            'rating'   => $validated['rating'],
            'comment'  => $validated['comment'],
        ]);

        return back()->with('success', 'Your review has been submitted successfully!');
    }
}
