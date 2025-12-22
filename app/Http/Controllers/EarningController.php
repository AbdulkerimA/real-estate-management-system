<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Balance;
use App\Models\CheckoutRequest;
use App\Models\Earning;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;
use PhpParser\Node\Stmt\TryCatch;

class EarningController extends Controller
{
    public function index (){
        $user = Auth::id();
        
        $agent = Agent::with(
                [
                    'earnings',
                    'balance',
                    'checkoutRequest'=>function ($query) {
                        $query->select('agent_id','requested_amount')
                                ->where('request_status','pending');
                    },

                ])
                    ->where('user_id',$user)
                    ->firstOrFail();

        // total pending checkout amount
        $pendingTotoal =  $agent->checkoutRequest->sum('requested_amount');

        // get current month and year
        $currentMonth = date('m');
        $currentYear = date('Y');

        // filter earnings for the current month
        $currentMonthEarnings = $agent->earnings->filter(function ($earning) use ($currentMonth, $currentYear) {
            $month = date('m', strtotime($earning->created_at));
            $year = date('Y', strtotime($earning->created_at));
            return $month == $currentMonth && $year == $currentYear;
        });

        $thisMonthTotal = $currentMonthEarnings->sum('total_earnings');


        $earningsByWeek = $agent->earnings->groupBy(function ($earning) {
            // extract week number from created_at
            $weekNumber = date('W', strtotime($earning->created_at));
            // also include the year to avoid mixing weeks from different years
            $year = date('Y', strtotime($earning->created_at));
            return 'week ' . $weekNumber; // e.g., "2025-W42"
        });

        $weeklyReport = $earningsByWeek->map(function ($items,$weekLabel) {
            return [
                'week' => $weekLabel,
                'total' => $items->sum('total_earnings'),
            ];
        })->values();


        $checkoutReq = CheckoutRequest::where('agent_id',$agent->id)->paginate(5);
        $transactions = Transaction::where('agent_id',$agent->user_id)->paginate(5);

        // dd($transactions,$weeklyReport,$earningsByWeek,$agent,$checkoutReq);   

        return view("agents.earning.index",[
            'agent' => $agent,
            'pendingTotal'=>$pendingTotoal,
            'thisMonthTotal' => $thisMonthTotal, 
            'weeklyReport' => $weeklyReport,
            'transactions' => $transactions,
            'checkOutReq' => $checkoutReq,
        ]);
    }

    // public function view(){}

    public function store(Request $request){

        // return response()->json($request->all());

        $validatedData = $request->validate([
            "amount"=>'required',
        ]);

        $user = Auth::user();
        $agent = $user->agentProfile;

        // return response()->json($user->agentProfile->id);
        $balance = $agent->balance->current_balance;
        $difference = $balance - $validatedData['amount'];

        if($difference < 0){
            $balance = Number::abbreviate($balance,2);
            return response()->json(['res'=>'error','message'=>'balace insufficent , your balance is ETB'.$balance]);
        }

        try{
            CheckoutRequest::create([
                'agent_id'          =>$agent->id,
                'requested_amount'  =>$validatedData['amount'],
            ]);

            // after the withdraw save the remaining balance it should returned when rejected by admin
            $agent->balance->current_balance = $difference;
            $agent->balance->save();
        }
        catch (Exception $ex){
            return response()->json(['res'=>'error','message'=>$ex->getMessage()]);
        }

        return response()->json(['res'=>'success','message'=>'your request will proccessed in 2-5 working days']);
    }

    public function cancelCheckOutReq(Request $request,CheckoutRequest $checkoutRequest){
        // dd($request->all(),$checkoutRequest);
        // add to balace
        $balance = Balance::where('agent_id', $checkoutRequest->agent_id)->first();

        if (!$balance) {
            abort(404, 'Balance not found');
        }

        $balance->current_balance += $checkoutRequest->requested_amount;
        $balance->save();

        // dd($balance->current_balance);
        $checkoutRequest->delete();

        return redirect('/dashboard/earnings')->with("message","request successfuly deleted");
    }

}
