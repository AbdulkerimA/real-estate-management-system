<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

use function PHPUnit\Framework\throwException;

class SessionController extends Controller
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
        return view('auth.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd(request()->post());
        //validate the inputs
        $validated = request()->validate([
            'email' => ['required'],
            'password' => ['required','string',],
        ]);

        // try to login the user
        if(!Auth::attempt($validated)){
            if(!Auth::attempt(['name'=>$validated['email'],'password'=>$validated['password'],])){
                throw ValidationException::withMessages(['error'=>'email or password is incorrect']);
            }
        }
        
        //create new session
        request()->session()->regenerate();

        // get the user
        $user = Auth::user();

        switch ($user->role) {
            case 'admin':
                return redirect('/admin');
                break;
            case 'agent':
                return redirect('/dashboard');
                break;
            default:
                return redirect('/properties');
                break;
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
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
        //dd($request->all())
        Auth::logout();
        return redirect('/');
    }
}
