<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AgentProfileConttroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    // display agents for admin 
    public function adminAgentsIndex(Agent $agents){

        $paginationNumber = request()->get('per_page') ?? 5;
        
        $numOfAgents = count($agents->all());
        $pendingAgents = $agents->all()->filter(function ($agent){
            return $agent->user->status == 'Pending';
        });
        $verifiedAgents = $agents->all()->filter(function ($agent){
            return $agent->user->status == 'Verified';
        });
        $suspendedAgents = $agents->all()->filter(function ($agent){
            return $agent->user->status == 'Suspended';
        });


        // dd($numOfAgents,$pendingAgents,$verifiedAgents,$suspendedAgents);

        return view('admin.agents.index',[
            'pendingAgents' => count($pendingAgents),
            'verifiedAgents' => count($verifiedAgents),
            'suspendedAgents' => count($suspendedAgents),
            'numOfAllAgents' => $numOfAgents,
            'agents' => $agents->paginate($paginationNumber), 
        ]);
    }

    public function getAgentInfo ($id){

        $agent = Agent::with(['user', 'media'])
            ->where('id',$id)
            ->first();

        

        if (!$agent) {
            return response()->json(['error' => 'Agent not found'], 404);
        }

         $recentProperties = $agent->user->properties
            ->sortByDesc('created_at')
            ->take(3)
            ->map(function ($property) {
            return [
                'id' => $property->id,
                'title' => $property->title,
                'location' => $property->location,
                'price' => $property->price,
                'propertyImage' => $property->media?->first()
                    ? asset('storage/' . $property->getFirstImage())
                    : null,
            ];
        })->toArray();

        // reviews
        $recentReviews = $agent->reviews()
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($review) {
                // dd($review->getReviewer());
                return [
                    'id' => $review->id,
                    'reviewer_name' => $review->user->name ?? 'Anonymous', // if reviewer is a user
                    'reviewer_avatar' => $review->user && $review->user->media 
                        ? asset('storage/' . $review->user->media->file_path) 
                        : null,
                    'rating' => $review->rating, // assuming rating field exists
                    'comment' => $review->comment ?? 'no comment',
                    'created_at' => $review->created_at->format('M d, Y'),
                ];
            })
            ->toArray();

            $ratings = $agent->reviews()->get('rating')->toArray();

            
        // dd($agent->reviews());
        // Return JSON for frontend
        return response()->json([
            'id' => $agent->id,
            'name' => $agent->user->name,
            'email' => $agent->user->email,
            'phone' => $agent->user->phone,
            'address' => $agent->address ?? '',
            'status' => $agent->user->status ?? '',
            'bio' => $agent->bio,
            'experience' => $agent->years_of_experience,
            'image' => asset('storage/' . $agent->media->file_path),
            'properties' => $agent->user->properties->count(),
            'recentProperties' => $recentProperties,
            'recentReviews'=>$recentReviews,
            'ratings'=>$ratings,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Agent $agent)
    {
        //
        // dd()
        $user = Auth::user();
        $properties = Property::with('details')->where('agent_id',Auth::id())->get();
        
        // dd($user->settings);
        
        return view('agents.profile.index',[
            'user' => $user,
            'properties'=> $properties
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agent $agent)
    {
        //

        $user = Auth::user();
        $properties = Property::with('details')->where('agent_id',Auth::id())->get();
        
        // dd($user->settings);
        
        return view('agents.profile.index',[
            'user' => $user,
            'properties'=> $properties
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agent $agent)
    {
        //
        // dd($request->all());
        // return json_encode($request->all()); // for js requests

        $validatedPassFilds = $request->validate([
            'current_password' => ['nullable', 'current_password'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $validatedPersonalInfo = $request->validate([
            'fullName' => ['nullable', 'string', 'max:100'],
            'email' => ['nullable', 'email', 'max:100', 'unique:users,email,' . Auth::id()],
            'phone' => ['nullable', 'string', 'max:20'],
            'location' => ['nullable', 'string', 'max:255'],
        ]);

        $validatedprofesionalInfo = $request->validate([
            'bio' => 'nullable|string|max:255',
            'about_me' => 'nullable|string|max:2550',
        ]);

        $validatedOption = $request->validate([
            'setting' => 'nullable|string',
            'value' => 'nullable|boolean',
        ]);

        // dd(Auth::user()->agentProfile);

        $user = Auth::user();

        


        if($validatedPassFilds){
            if(!Hash::check($validatedPassFilds['current_password'],$user->password)){
                return back()->withErrors(['password' => 'password incorrect']);
            }

            // update the password 
            $user->update([
                'password' => $validatedPassFilds['password']
            ]);

            return back()->with("success","password updated successfuly");
        }

        // update personal info
        if($validatedPersonalInfo){
            $user->update([
                'name' => $validatedPersonalInfo['fullName'],
                'email' => $validatedPersonalInfo['email'],
                'phone' => $validatedPersonalInfo['phone'],
            ]);

            $user->agentProfile->update([
                'address' => $validatedPersonalInfo['location'],
            ]);

            return back()->with('success','y prsonal info updated successful');
        }

        if ($validatedprofesionalInfo) {
            $user->agentProfile->update([
                'bio' => $validatedprofesionalInfo['bio'],
                'about_me' => $validatedprofesionalInfo['about_me'],
            ]);

            return back()->with('success','professional info updated successfuly ');
        }

        // update setting option
        if($validatedOption){
            if($validatedOption['setting'] == 'email_authentication'){
                $user->settings->update([
                    'two_factor_authentication' => $validatedOption['value'],
                ]);
            }

            return response()->json([
                'message' => 'Preference updated successfully.',
                'status' => $validatedOption['value'],
            ]);
        }
    }

    public function verify(Agent $agent)
    {
        // return response()->json(['POST' => $agent->user]);
        try {
            
            if (! $agent->user) {
                return response()->json([
                    'message' => 'Agent has no associated user',
                ], 422);
            }

            $agent->user->status = 'Verified';
            $agent->user->save();

            return response()->json([
                'message' => 'Agent verified successfully',
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Verification failed',
            ], 500);
        }
    }


    public function suspend(Agent $agent)
    {
        $agentStatus = $agent->user->status;

        if($agentStatus == 'Suspended')
            $agent->user->update(['status' => 'Verified']);
        else
            $agent->user->update(['status' => 'Suspended']);

        return response()->json([
            'message' => 'Agent suspended successfully',
            'status' => $agent->user->status
        ]);
    }

    public function destroy(Agent $agent)
    {
        // return response()->json(['agent'=>$agent]);
        $agent->user->delete();
        $agent->delete();

        return response()->json([
            'message' => 'Agent deleted successfully'
        ]);
    }
}
