<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\json;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        
        $user = Auth::user();
        $appointmentsCollection = Appointment::with('property')->where('buyer_id',$user->id)->get();

        $appointments = [];
        foreach ($appointmentsCollection as $key => $value) {
            $appointments[] = [
                'id'        => $value->id,
                'property'  => $value->property->title,
                'icon'      =>json_decode( $value->property->media->file_path)[0],
                'agent'     => $value->property->user->name,
                'phone'     => $value->property->user->phone,
                'email'     => $value->property->user->email,
                'date'      => $value->scheduled_date,
                'time'      => $value->scheduled_time,
                'status'    => $value->status,
                'price'     => "ETB ".$value->property->price,
                'location'  => $value->property->location,
            ];
        }

        $pendingAppointments = $appointmentsCollection->filter(function ($appointment){
            return $appointment->status == 'pending';
        });

        $completedAppointments = $appointmentsCollection->filter(function ($appointment){
            return $appointment->status == 'completed';
        });

        $cancelledAppointments = $appointmentsCollection->filter(function ($appointment){
            return $appointment->status == 'cancelled';
        });
        // dd(count($cancelledAppointments));

        return view('schedule.index',[
            'appointments' => $appointments,
            'allAp'=>count($appointmentsCollection),
            'pendingAp' => count($pendingAppointments),
            'completedAp'=>count($completedAppointments),
            'cancelledAp' => count($cancelledAppointments),
        ]);
    }

    public function dashboardIndex()
    {
        // dd(request()->get('per_page'));
        $agent = Auth::user();        
        $propertIds = Property::where('agent_id',$agent->id);
        $perPage = request()->get('per_page') ?? 5;
        $appointmentsCollection = Appointment::whereIn('property_id',$propertIds->pluck('id'))
                                     ->orderBy('scheduled_date', 'desc')
                                     ->orderBy('scheduled_time', 'desc')
                                     ->paginate($perPage);
        // dd($appointments);
        
        $appointments = [];
        foreach ($appointmentsCollection as $key => $value) {
            $appointments[] = [
                'id'        => $value->id,
                'property'  => $value->property->title,
                'icon'      =>json_decode( $value->property->media->file_path)[0],
                'agent'     => $value->property->user->name,
                'phone'     => $value->property->user->phone,
                'email'     => $value->property->user->email,
                'date'      => $value->scheduled_date,
                'time'      => $value->scheduled_time,
                'status'    => $value->status,
                'price'     => "ETB ".$value->property->price,
                'location'  => $value->property->location,
            ];
        }

        if($agent->role == 'agent'){
            return view('agents.appointments.index',
            [
                'appointments' => $appointmentsCollection,
                'appointments_' => $appointments,
            ]);
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

        // return redirect("/property/".$validated['propertyId']."/success");
        return redirect('/schedules');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        // 
        dd($appointment);
        return json_encode($appointment);
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
    public function statusUpdate(Request $request, Appointment $appointment)
    {
        dd($request->all());

        $validated = $request->validate([ 
            'status' => 'required|in:confirmed,completed,cancelled',
        ]);

        // dd($validated);
        // $user = Auth::id();

        $appointment->update([
            'status'=> $validated['status'],
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
