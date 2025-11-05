<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Property;
use App\Models\Transaction;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        /**
         * monthly revenue should be calculated as
         * all monthly Transactions minus agents commission
         */
        $monthlyTransactions = Transaction::select(
            DB::raw("strftime('%m', created_at) as month"),
            DB::raw('COUNT(*) as count'),
        )
            ->whereRaw("strftime('%Y', created_at) = ?", date('Y'))
            ->groupBy('month')
            ->get();
        $monthlyTransactions->transform(function ($item) {
            $item->month_name = date('M', mktime(0, 0, 0, $item->month, 10));

            return $item;
        });
        /**
         * properties grouped by catatory
         */
        $propertiesByCatagory = Property::select(
            DB::raw('type as catagory'),
            DB::raw('COUNT(*) as count'),
        )
                            // ->whereRaw("strftime('%Y', created_at) = ?",date('Y'))
            ->groupBy('catagory')
            ->get();

        $propertiesByLocation = Property::select(
            DB::raw('location as address'),
            DB::raw('COUNT(*) as count'),
        )
            ->groupBy('address')
            ->get();

        $topAgents = Agent::orderByDesc('deals_closed')->limit(3)->get(['user_id', 'deals_closed']);
        $topAgents->transform(function ($item){
            // dd($item->user->name);
            $item->agent_name = $item->user->name;
            return $item;
        });

        $sumOfAllAgentsDeals = Agent::sum('deals_closed');
        $sumOfTopAgentsDeals = 0;

        foreach ($topAgents as $value) {
            $sumOfTopAgentsDeals = $sumOfTopAgentsDeals + (int) $value->deals_closed;
        }
        $dealsClosedByOthers = $sumOfAllAgentsDeals - $sumOfTopAgentsDeals; 

        $properties = Property::all('id');
        $propertySold = Property::where('status', 'sold')->get('id');
        $activeAgents = User::where(['role' => 'agent', 'status' => 'Verified'])->get('id');
        $activecustomers = User::where(['role' => 'customer', 'status' => 'Verified'])->get('id');

        // dd($topAgents,$dealsClosedByOthers, $sumOfAllAgentsDeals, $monthlyTransactions, $propertiesByCatagory);

        return view('admin.analytics.index', [
            'monthlyRevenue' => $monthlyTransactions,
            'propertiesByCatagory' => $propertiesByCatagory,
            'propertiesByLocation' => $propertiesByLocation,
            'allProperties' => count($properties),
            'soldProperties' => count($propertySold),
            'agents' => count($activeAgents),
            'customers' => count($activecustomers),
            'topAgents' => $topAgents,
            'dealsClosedByOthers' => $dealsClosedByOthers,
        ]);

    }
    public function generatePdf(){

        $monthlyTransactions = Transaction::select(
            DB::raw("strftime('%m', created_at) as month"),
            DB::raw('COUNT(*) as count'),
        )
            ->whereRaw("strftime('%Y', created_at) = ?", date('Y'))
            ->groupBy('month')
            ->get();
        $monthlyTransactions->transform(function ($item) {
            $item->month_name = date('M', mktime(0, 0, 0, $item->month, 10));

            return $item;
        });
        /**
         * properties grouped by catatory
         */
        $propertiesByCatagory = Property::select(
            DB::raw('type as catagory'),
            DB::raw('COUNT(*) as count'),
        )
                            // ->whereRaw("strftime('%Y', created_at) = ?",date('Y'))
            ->groupBy('catagory')
            ->get();

        $propertiesByLocation = Property::select(
            DB::raw('location as address'),
            DB::raw('COUNT(*) as count'),
        )
            ->groupBy('address')
            ->get();

        $topAgents = Agent::orderByDesc('deals_closed')->limit(3)->get(['user_id', 'deals_closed']);
        $topAgents->transform(function ($item){
            // dd($item->user->name);
            $item->agent_name = $item->user->name;
            return $item;
        });

        $sumOfAllAgentsDeals = Agent::sum('deals_closed');
        $sumOfTopAgentsDeals = 0;

        foreach ($topAgents as $value) {
            $sumOfTopAgentsDeals = $sumOfTopAgentsDeals + (int) $value->deals_closed;
        }
        $dealsClosedByOthers = $sumOfAllAgentsDeals - $sumOfTopAgentsDeals; 

        $properties = Property::all('id');
        $propertySold = Property::where('status', 'sold')->get('id');
        $activeAgents = User::where(['role' => 'agent', 'status' => 'Verified'])->get('id');
        $activecustomers = User::where(['role' => 'customer', 'status' => 'Verified'])->get('id');
        
        // dd($topAgents,$dealsClosedByOthers, $sumOfAllAgentsDeals, $monthlyTransactions, $propertiesByCatagory);

        $pdfView = Pdf::loadView('admin.analytics.index',[
            'monthlyRevenue' => $monthlyTransactions,
            'propertiesByCatagory' => $propertiesByCatagory,
            'propertiesByLocation' => $propertiesByLocation,
            'allProperties' => count($properties),
            'soldProperties' => count($propertySold),
            'agents' => count($activeAgents),
            'customers' => count($activecustomers),
            'topAgents' => $topAgents,
            'dealsClosedByOthers' => $dealsClosedByOthers,
        ]);

        return $pdfView->stream('report.pdf');
    }
}
