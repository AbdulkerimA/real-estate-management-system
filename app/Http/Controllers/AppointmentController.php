<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(request()->get('per_page'));
        $agent = Auth::user();        
        $propertIds = Property::where('agent_id',$agent->id);
        $perPage = request()->get('per_page') ?? 5;
        $appointments = Appointment::whereIn('property_id',$propertIds->pluck('id'))
                                     ->orderBy('scheduled_date', 'desc')
                                     ->orderBy('scheduled_time', 'desc')
                                     ->paginate($perPage);
        // dd($appointments);

        if($agent->role == 'agent'){
            return view('agents.appointments.index',['appointments' => $appointments]);
        }else{
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Property $property)
    {
        // dd();
        $agent = User::find($property->agent_id);
        return view('schedule.create',['property' => $property , 'agent' => $agent]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // for debuging only 
        // dd($request->post());

         $validated = $request->validate([
            'propertyId' => "required",
            'prefDate'      => "required|date|after_or_equal:today",
            'prefTime'      => "required|date_format:H:i",
            'contactMethod' => "required|in:call,email,sms", // adjust options as needed
            'note'         => "nullable|string|max:1000",
        ]);

        Appointment::create([
            'buyer_id' => Auth::user()->id,
            'property_id' => $validated['propertyId'],
            'scheduled_date' => $validated['prefDate'],
            'scheduled_time' => $validated['prefTime'],
            'contact_method' => $validated['contactMethod'],
            'additional_note' => $validated['note'],
        ]);

        return redirect("/property/".$validated['propertyId']."/success");
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
