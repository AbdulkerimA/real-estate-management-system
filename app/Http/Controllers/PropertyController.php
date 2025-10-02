<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::paginate(20);
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

        // dd($property);

        return view('properties.show',['property'=>$property, 'properties' => $relatedProperties,'agent'=>$agent]);
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
