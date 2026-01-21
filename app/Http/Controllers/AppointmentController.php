<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Balance;
use App\Models\Property;
use App\Models\Transaction;
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
        $appointmentsCollection = Appointment::with('property')
                    ->where('buyer_id',$user->id)
                    ->orderByDesc('created_at')
                    ->get();

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
                'note'      => $value->additional_note,
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
        // dd(count($cancelledAppointments ));

        return view('schedule.index',[
            'appointments' => $appointments,
            'allAp'=>count($appointmentsCollection),
            'pendingAp' => count($pendingAppointments),
            'completedAp'=>count($completedAppointments),
            'cancelledAp' => count($cancelledAppointments),
        ]);
    }

    /**
     * search specific types of appointments
     */
    public function search(Request $request)
    {
        $query = Appointment::query()
            ->with(['client', 'property.media']);

        // 🔍 Text search
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->whereHas('client', fn ($c) =>
                        $c->where('name', 'like', "%{$q}%")
                    )
                    ->orWhereHas('property', fn ($p) =>
                        $p->where('title', 'like', "%{$q}%")
                    );
            });
        }

        // 📌 Status filter
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // 📅 Date range
        if ($request->filled('start_date')) {
            $query->whereDate('scheduled_date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('scheduled_date', '<=', $request->end_date);
        }

        $appointments = $query
            ->latest()
            ->paginate(10);

        // Return ONLY table rows
        return view(
            'agent.appointments.partials.table-rows',
            compact('appointments')
        );
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
        // dd($request->all(),$appointment);

        $validated = $request->validate([ 
            'status' => 'required|in:confirmed,completed,cancelled',
        ]);

        // dd($validated);
        // $user = Auth::id();

        $appointment->update([
            'status'=> $validated['status'],
        ]);

        return redirect("/dashboard/appointments")->with('message','appointment cancelled');
    }

    /**
     * update the schedule time and date of the specified resource in DB
     */
    public function reschedule(Request $request, Appointment $appointment)
    {
        // Only buyer can reschedule
        if ($appointment->buyer_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        // Cannot reschedule cancelled or completed
        if (in_array($appointment->status, ['completed', 'cancelled'])) {
            return response()->json([
                'message' => 'This appointment cannot be rescheduled'
            ], 422);
        }

        $validated = $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
        ]);

        $appointment->update([
            'scheduled_date' => $validated['date'],
            'scheduled_time' => $validated['time'],
            'status' => 'pending', // optional: reset status
        ]);

        return response()->json([
            'message' => 'Appointment rescheduled successfully',
            'date' => $validated['date'],
            'time' => $validated['time'],
        ]);
    }

    /**
     * update the status of the specified resource to cancel in DB
     */
    public function cancel(Appointment $appointment)
    {
        // Authorization: only the buyer can cancel
        if ($appointment->buyer_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        // Prevent cancelling completed appointments
        if ($appointment->status === 'completed') {
            return response()->json([
                'message' => 'Completed appointments cannot be cancelled'
            ], 422);
        }

        $appointment->update([
            'status' => 'cancelled',
        ]);

        return response()->json([
            'message' => 'Appointment cancelled successfully',
            'status'  => 'cancelled',
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function complete(Appointment $appointment)
    {
        $user = Auth::user();

        // Only agent who owns the property can complete
        // if ($user->role !== 'agent' || $appointment->property->agent_id !== $user->id) {
        //     abort(403, 'Unauthorized');
        // }

        if (in_array($appointment->status, ['completed', 'cancelled'])) {
            return response()->json([
                'message' => 'This appointment cannot be completed'
            ], 422);
        }

        $appointment->update([
            'status' => 'completed',
        ]);

        return response()->json([
            'message' => 'Appointment marked as completed',
            'status'  => 'completed',
        ]);
    }

    public function pay(Appointment $appointment)
    {
        // dd($appointment);
        // Only buyer can pay
        if ($appointment->buyer_id !== Auth::id()) {
            return response()->json([
                'message' => 'unaothorized'
            ], 403);
        }

        // Only completed appointments can be paid
        if ($appointment->status !== 'completed') {
            return response()->json([
                'message' => 'Only completed appointments can be paid'
            ], 422);
        }

        // Prevent duplicate payments
        if (Transaction::where('property_id', $appointment->property_id)
            ->where('buyer_id', Auth::id())
            ->exists()) {
            return response()->json([
                'message' => 'This appointment is already paid'
            ], 422);
        }

        Transaction::create([
            'buyer_id'     => Auth::id(),
            'agent_id'     => $appointment->property->agent_id,
            'property_id'  => $appointment->property_id,
            'offer_amount' => $appointment->property->price,
            'status'       => 'confirmed',
        ]);

        $balance = Balance::where('agent_id',$appointment->property->agent_id)->first();
        $property = Property::where('id',$appointment->property_id)->first();

        $property?->update([
            'status' => 'sold'
        ]);

        $newBalance = $balance?->current_balance + ($appointment->property->price * 0.05); //5% cut
        
        $balance?->update([
            'current_balance' => $newBalance
        ]);

        return response()->json([
            'message' => 'Payment successful'
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Appointment $appointment)
    {
        // Only buyer can delete
        if ($appointment->buyer_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        // Only completed appointments can be deleted
        if ($appointment->status !== 'completed' && $appointment->status !== 'cancelled') {
            return response()->json([
                'message' => 'Only completed appointments can be removed'
            ], 422);
        }

        $appointment->delete();

        return response()->json([
            'message' => 'Appointment removed successfully'
        ]);
    }

}
