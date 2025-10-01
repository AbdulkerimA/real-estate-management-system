<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.show');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd(request()->post());
        //validate the inputs
        $validated = $request->validate([
            'fullName' => ['required','string','min:2','regex:/^[a-zA-Z\s\'\-]+$/'],
            'email' => ['required','email','unique:users,email'],
            'phone' => ['required','regex:/^\+?[1-9]\d{0,15}$/','unique:users,phone',],
            'password' => ['required','string','min:6','confirmed',],
        ],
        [
            // Custom error messages
            'fullName.regex' => 'Full name can only contain letters, spaces, apostrophes, and hyphens',
            'terms.accepted' => 'You must accept the Terms & Conditions',
        ]);

        //store the data to the DB
        $user = User::create([
            'name' => $validated['fullName'],
            'email' => $validated['email'],
            'phone' => ltrim($validated['phone'], '+'),
            'password' => $validated['password'],
            'role'=>'customer',
        ]);

        //login the user
        Auth::login($user);

        //redirct to properties page
        return redirect('/properties');
    } 

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //grap the user data 
        //open the profile page
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
