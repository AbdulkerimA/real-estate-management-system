<?php

namespace App\Http\Controllers;

use App\Exports\AgentsExport;
use App\Models\Agent;
use App\Models\Document;
use App\Models\Media;
use App\Models\Property;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agents = Agent::with('user')->paginate(20);
        // dd();
        return view('agents.index',['agents'=>$agents]);
    }

    // export users data in excel format
    public function export(){
        return Excel::download(new AgentsExport,'top-performing-agents.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->hasFile('documentInput'));
        // dd($request->post());
        
        $validated = request()->validate([
            'fullName'        => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email',
            'phone'           => 'required|string|max:25',
            'location'        => 'required|string|max:255',
            'password'        => 'required|min:8|confirmed', 
            'profilePic'      => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'documentInput.*'   => 'required|mimes:jpg,jpeg,png,pdf|max:5120',
            'bio'             => 'required|string|min:10|max:255',
            'about'           => 'required|string|min:200|max:2550',
            'speciality'      => 'required|string|in:apartments,houses,land,commercial,luxury,all',
            'experience'      => 'required|integer|min:0|max:50',
            'agreeTerms'      => 'accepted',
            'confirmAccuracy' => 'accepted',
        ]);

        // file storing and path extraction
        $profilePicPath = request()->file('profilePic')->store('profiles','public');
        $profileFileType = request()->file('profilePic')->getClientMimeType();
        $documentPaths = [];
        $documentFileType = [];
        foreach (request()->file('documentInput') as $file) {

            $documentPaths[] =$file->store('agentDocuments','public');
            $documentFileType[] = $file->getClientMimeType();

        }

        $user = User::create([
            'name' => $validated['fullName'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => $validated['password'],
            'role' => 'agent',
        ]);

        $setting = Setting::create([
            'user_id' => $user->id,
        ]);

        $media = Media::create([
            'file_path' => $profilePicPath,
            'file_type' => $profileFileType,
        ]);

         $document = Document::create([
            'file_path' => json_encode($documentPaths),
            'doc_type' => json_encode($documentFileType),
        ]);

        $agent = Agent::create([
            'user_id' => $user->id,
            'media_id' => $media->id,
            'document_id' => $document->id,
            'bio' => $validated['bio'],
            'about_me' => $validated['about'],
            'address' => $validated['location'],
            'speciality' => $validated['speciality'],
            'years_of_experience' => $validated['experience'],
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    } 

    /**
     * Display the specified resource.
     */
    public function show(Agent $agent)
    {
        
        $properties = Property::where('agent_id',$agent->user_id)->get();
        // dd($properties[0]);
        return view('agents.show',['agent'=>$agent,'properties'=>$properties]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agent $agent)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agent $agent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agent $agent)
    {
        //
    }
}
