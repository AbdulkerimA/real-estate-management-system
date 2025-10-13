<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $this->authorize('update', );

        $agent_id = $request->get('id');
        if($agent_id == null)
            $properties = Property::with('details')->where('status','approved')->paginate(10);
        else
            $properties = Property::with('details')->where('agent_id',$agent_id)->paginate(10);
        
        // dd($properties);
        return view('properties.index',['properties'=>$properties]);
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
    public function show(Property $property)
    {
        $relatedProperties = Property::where('type',value:$property->type);
        $agent = Agent::where('user_id',$property->agent_id)->first();
        // $scheduled = $property->appointments->first()->buyer->is(Auth::user()); // costs us one more query
        $appointment = $property->appointments;
        $scheduled = optional($appointment->first())->buyer_id == Auth::user()->id;
        // dd();

        return view('properties.show',[
            'property'=>$property, 
            'properties' => $relatedProperties,
            'agent'=>$agent,
            'scheduled'=>$scheduled,
        ]);
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
