<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Property;
use App\Models\PropertyDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardPropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::where('agent_id',Auth::id())
                                ->paginate(10);
        return view('agents.properties.index',['properties'=>$properties]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agents.properties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // see request content for debuging
        // dd($request->post());
        // dd($request->hasFile('images'));
        
        //validation 
        $validated = $request->validate([
            // Property Information
            'title'       => 'required|string|max:255',
            'type'        => 'required|in:house,apartment,land,commercial,villa,condominium',
            'price'       => 'required|numeric|min:0',
            'location'    => 'required|string|max:255',
            'longitude'   => 'required|numeric|between:-180,180',
            'latitude'    => 'required|numeric|between:-90,90',
            'description' => 'required|string',

            // Property Details
            'bedrooms'    => 'nullable|integer|min:0|max:20',
            'bathrooms'   => 'nullable|numeric|min:0|max:20',
            'area'        => 'nullable|numeric|min:0',
            'yearBuilt'   => 'nullable|integer|min:1900|max:' . date('Y'),

            // Amenities (array of multiple checkboxes)
            'amenities'   => 'nullable|array',
            'amenities.*' => 'in:parking,balcony,pool,security,garden,gym',

            // Property Images (multiple)
            'images'      => 'required|min:1',
            'images.*'    => 'image|mimes:jpg,jpeg,png,webp|max:5120', // 5MB max

            // Availability & Status
            // 'featured'    => 'nullable|boolean',
        ]);

        // dd($validated['amenities']);
        $agent = Auth::user();
        $amenities = $validated['amenities'] ?? [];
        $paths = [];
        $fileTypes = [];

        // dd($agent->id);
        //file store
        foreach (request()->file('images') as $file) {
            //store the file
            $paths[] = $file->store('properties','public');
            $fileTypes[] = $file->getClientMimeType();
        }

        // dd($fileTypes);
        //store to db
        $media = Media::create([
            'file_path' => json_encode($paths),
            'file_type' => json_encode($fileTypes)
        ]);

        $property = Property::create([
            'agent_id' => $agent->id,
            'media_id' => $media->id,
            'title' => $validated['title'],
            'type' => $validated['type'],
            'price' => $validated['price'],
            'location' => $validated['location'],
            'longitude' => $validated['longitude'],
            'latitude' => $validated['latitude'],
            'description' => $validated['description'],
            // 'is_hignlighted' => $validated['featured']
        ]);

        PropertyDetail::create([
            'property_id' => $property->id,
            'bed_rooms' => $validated['bedrooms'], 
            'bath_rooms' => $validated['bathrooms'], 
            'area_size' => $validated['area'], 
            'year_built' => $validated['yearBuilt'], 
            'parking' => in_array('parking',$amenities),
            'balcony' => in_array('balcony',$amenities),
            'swimming_pool' => in_array('pool',$amenities),
            'security' => in_array('security',$amenities),
            'garden' => in_array('garden',$amenities),
            'gym' => in_array('gym',$amenities),
        ]);

        //redirct to properties page
        return redirect('/dashboard/properties');
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        //
    }
}
