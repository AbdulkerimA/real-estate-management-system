<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Balance;
use App\Models\CheckoutRequest;
use App\Models\Earning;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Chart\Properties;

class AgentDashboardController extends Controller
{
    //
    public function index(){

        $user = Auth::user();
        $agent = $user->agentProfile;

        // properties listed
        $properties = Property::select('id')->where('agent_id',$user->id)->get();
        
        // current balance
        $balance = Balance::select('current_balance')->where('agent_id',$agent->id)->first();

        // total checkouts
        $checkOuts = CheckoutRequest::select('requested_amount')
                                        ->where(['request_status'=>'approved','agent_id'=>$agent->id])
                                        ->get();
        $totalCheckOut =0;
        foreach($checkOuts as $checkout){
            $totalCheckOut += $checkout->requested_amount;
        }

        // this month earnings (pending checkouts) 
        $pendingCheckOuts = CheckoutRequest::select('requested_amount')
                                        ->where(['request_status'=>'pending','agent_id'=>$agent->id])
                                        ->get();


        $latestProperties = Property::where(['agent_id'=>$agent->id])
                                    ->with('details')
                                    ->orderByDesc('created_at')
                                    ->limit(3)
                                    ->get();

        $latestAppointments = Appointment::whereIn('property_id',function($query){
                                        $query->select('id')
                                              ->from('properties')
                                              ->where('agent_id',Auth::id());
                                    })
                                    // ->with('details')
                                    ->orderByDesc('created_at')
                                    ->limit(3)
                                    ->get();

        
        $monthlyEarnings = Earning::select(
                                DB::raw("strftime('%m', created_at) as month"),
                                DB::raw("sum(total_earnings) as earned"),
                                DB::raw('COUNT(*) as count'),
                            )
                            ->where('agent_id',$user->id)
                            ->whereRaw("strftime('%Y', created_at) = ?",date('Y'))
                            ->groupBy('month')
                            ->get();


        $monthlyEarnings->transform(function($item) {
            $item->month_name = date('M', mktime(0, 0, 0, $item->month, 10));
            return $item;
        });

        // dd(count($properties),$balance,$totalCheckOut,$checkOuts);
        // dd($latestProperties->first()->getFirstImage(),$monthlyEarnings);
        // dd($latestAppointments->first()->property->title);

        return view('agents.dashboard',[
            'propertiesCount'   => count($properties),
            'balance'           => $balance,
            'totalCheckout'     => $totalCheckOut,
            'pendingCheckout'   => count($pendingCheckOuts),
            'latestProperties'  => $latestProperties,
            'monthlyEarnings'   => $monthlyEarnings,
            'appointments'      => $latestAppointments,
        ]);
    }
}
