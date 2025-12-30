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
    public function adminAgentsIndex(User $users,){

        $perPage = request()->get('per_page', 10);

        // Base query (customers only)
        $customersQuery = User::where('role', 'customer');

        // Status counts (FAST & CORRECT)
        $totalCustomers    = (clone $customersQuery)->count();
        $verifiedCustomers = (clone $customersQuery)->where('status', 'Verified')->count();
        $suspendedCustomers= (clone $customersQuery)->where('status', 'Suspended')->count();
        $pendingCustomers  = (clone $customersQuery)->where('status', 'Pending')->count();

        // Paginated customers for table
        $customers = $customersQuery
            ->latest()
            ->paginate($perPage);

        return view('admin.customers.index', [
            'customers'          => $customers,
            'totalCustomers'     => $totalCustomers,
            'verifiedCustomers'  => $verifiedCustomers,
            'suspendedCustomers' => $suspendedCustomers,
            'pendingCustomers'   => $pendingCustomers,
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
        $bookmarkedProperties = $user->bookings()
        ->latest()
        ->take(6)
        ->get()
        ->map(function ($property) {
            return [
                'id'       => $property->id,
                'title'    => $property->title,
                'location' => $property->location,
                'price'    => $property->price,
                'image'    => $property->images->first()
                                ? asset('storage/' . $property->images->first()->path)
                                : null,
            ];
        });

        $purchases = $user->transactions()
            ->with('property.images')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($purchase) {
                return [
                    'id'       => $purchase->id,
                    'title'    => $purchase->property->title,
                    'location' => $purchase->property->location,
                    'price'    => $purchase->amount,
                    'date'     => $purchase->created_at->format('M d, Y'),
                    'status'   => $purchase->status,
                    'image'    => $purchase->property->getFirstImage()
                                    ? asset('storage/' . $purchase->property->images->first()->path)
                                    : null,
                ];
            });
        // dd($bookmarkedProperties);
        //grap the user data 
        //open the profile page
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'status' => $user->status, // e.g., Active/Suspended
            'email' => $user->email,
            'phone' => $user->phone,
            // 'location' => $user->location,
            'joined_at' => $user->created_at,
            'bookmarked_properties' => $user->bookings()->count(),
            'bookmarked_properties' => $bookmarkedProperties,
            'purchases' => $purchases,
        ]);
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

    public function suspend(User $user)
    {
        // return response()->json(['post'=>$user]);
        if(!$user){
            return response()->json(['message'=>'user not found']);
        }

        if($user->status == 'Suspended')
            $user->update(['status' => 'Verified']);
        else
            $user->update(['status' => 'Suspended']);

        return response()->json([
            'message' => 'Buyer suspended successfully',
            'status'  => 'suspended',
        ]);
    }

    public function reactivate(User $user)
    {
        $user->update(['status' => 'verified']);

        return response()->json([
            'message' => 'Buyer reactivated successfully',
            'status'  => 'verified',
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'Buyer deleted successfully',
        ]);
    }
}
