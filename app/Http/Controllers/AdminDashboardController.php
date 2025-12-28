<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Property;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $totalProperties = Property::count();
        $verifiedAgents = User::where('role', 'agent')->count();
        $activeBuyers = User::where('role', 'customer')->count();
        $totalRevenue = Transaction::where('status', 'approved')->sum('offer_amount');

        // Recent transactions
        $status = $request->get('status', 'all');
        $search = $request->get('search'); // NULL if empty


        $recentTransactions = Transaction::with(['buyer', 'property'])
            ->when($status !== 'all', function ($q) use ($status) {
                $q->where('status', $status);
            })
            ->when(!empty($search), function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->whereHas('buyer', function ($qb) use ($search) {
                        $qb->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('property', function ($qp) use ($search) {
                        $qp->where('title', 'like', "%{$search}%");
                    });
                });
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        $agentPerformance = Agent::with('user')
            ->leftJoin('earnings', 'agents.id', '=', 'earnings.agent_id')
            ->select(
                'agents.id',
                DB::raw('SUM(earnings.total_earnings) as total_earnings')
            )
            ->groupBy('agents.id')
            ->get();
        $agentLabels = [];
        $agentValues = [];

        foreach ($agentPerformance as $agent) {
            if ($agent->total_earnings > 0) {
                $username = Agent::find($agent->id)->user->name;
                // dd($username);
                $agentLabels[] = $username ?? 'Unknown';
                $agentValues[] = $agent->total_earnings;
            }
        }

        // monthly revdnue
        $monthlyRevenue = Transaction::where('status', 'confirmed')
            ->whereYear('created_at', now()->year)
            ->select(
                DB::raw("CAST(strftime('%m', created_at) AS INTEGER) as month"),
                DB::raw('SUM(offer_amount) as total')
            )
            ->groupBy(DB::raw("strftime('%m', created_at)"))
            ->orderBy('month')
            ->get();

        /**
         * Prepare chart data
         */
        $months = [];
        $revenues = [];

        for ($m = 1; $m <= 12; $m++) {
            $months[] = Carbon::create()->month($m)->format('M');

            $match = $monthlyRevenue->firstWhere('month', $m);
            $revenues[] = $match ? (float) $match->total : 0;
        }

        // property sales
        $propertySales = Transaction::where('status', 'confirmed')
            ->select('property_id')
            ->with('property')
            ->get()
            ->groupBy(fn($transaction) => $transaction->property?->type ?? 'Unknown');

        $categories = [];
        $salesCounts = [];

        // dd($propertySales);
        
        foreach ($propertySales as $type => $transactions) {
            $categories[] = $type;
            $salesCounts[] = count($transactions);
        }


        // dd(compact(
        //     'totalProperties',
        //     'verifiedAgents',
        //     'activeBuyers',
        //     'totalRevenue',
        //     'recentTransactions'
        // ));
        // dd($agentPerformance,$agentLabels,$agentValues);

        return view('admin.dashboard', compact(
            'totalProperties',
            'verifiedAgents',
            'activeBuyers',
            'totalRevenue',
            'recentTransactions',
            'agentLabels',
            'agentValues',
            'months',
            'revenues',
            'categories',
            'salesCounts',
        ));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
