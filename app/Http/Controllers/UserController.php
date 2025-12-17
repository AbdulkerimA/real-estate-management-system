<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\Customer;
use App\Models\Media;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function export (){
         return Excel::download(new UsersExport, 'users.xlsx');
    }
    // display agents for admin 
    public function adminAgentsIndex(User $users){

        $paginationNumber = request()->get('per_page') ?? 5;
        
        $numOfUsers = $users->all()->where('role','customer');

        $pendingUsers = $users->all()->filter(function ($user){
            return $user->status == 'pending';
        });
        $verifiedUsers = $users->all()->filter(function ($user){
            return $user->status == 'verfied';
        });
        $suspendedUsers = $users->all()->filter(function ($user){
            return $user->status == 'suspended';
        });

        // dd($numOfUsers,$pendingUsers,$verifiedUsers,$suspendedUsers);

        return view('admin.customers.index',[
            'pendingUsers' => count($pendingUsers),
            'verifiedUsers' => count($verifiedUsers),
            'suspendedUsers' => count($suspendedUsers),
            'numOfAllUsers' => count($numOfUsers),
            'users' => $users->paginate($paginationNumber)->where('role','customer'), 
        ]);
    }

    public function getUsertInfo ($id){

        $user = User::with(['user', 'media'])->where('id',$id)->first();

        

        if (!$user) {
            return response()->json(['error' => 'user not found'], 404);
        }

        // dd($user);
        // Return JSON for frontend
        return response()->json([
            'id' => $user->id,
            'name' => $user->user->name,
            'email' => $user->user->email,
            'phone' => $user->user->phone,
            'address' => $user->address ?? '',
            'status' => $user->user->status ?? '',
        ]);
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
        
        $settings = Setting::create(['user_id'=>$user->id]);
        $media = Media::create([
            'file_path' => '',
            'file_type' => '',
        ]);
        $profile = Customer::create([
            'user_id'   => $user->id,
            'media_id'  => $media->id,
            'address'   => '',
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
