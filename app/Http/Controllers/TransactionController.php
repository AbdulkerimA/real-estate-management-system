<?php

namespace App\Http\Controllers;

use App\Models\CheckoutRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(Request $request){
        $perPage = request()->get('per_page') ?? 5; 

         // payout table 
        $payoutQuery = CheckoutRequest::with(['agent.user', 'agent.media']);

        //Search by agent name
        if ($request->filled('payout_search')) {
            $payoutQuery->whereHas('agent.user', fn ($q) =>
                $q->where('name', 'LIKE', "%{$request->payout_search}%")
            );
        }

        //Status filter
        if ($request->filled('payout_status')) {
            $payoutQuery->where('request_status', $request->payout_status);
        }

        $checkOuts = $payoutQuery->latest()->paginate(5);

        // AJAX for payout table
        if ($request->ajax() && $request->has('payout')) {
            return response()->json([
                'html' => view(
                    'admin.payment.partials.payouts-table',
                    compact('checkOuts')
                )->render()
            ]);
        }
        
        $transactionsQuery = Transaction::with(['buyer', 'agent', 'property']);

        // Search
        if ($request->filled('tsearch')) {
            $search = $request->tsearch;

            $transactionsQuery->where(function ($q) use ($search) {
                $q->whereHas('buyer', fn ($q) =>
                    $q->where('name', 'LIKE', "%{$search}%")
                )
                ->orWhereHas('agent', fn ($q) =>
                    $q->where('name', 'LIKE', "%{$search}%")
                )
                ->orWhereHas('property', fn ($q) =>
                    $q->where('name', 'LIKE', "%{$search}%")
                );
            });
        }

        // Status Filter
        if ($request->filled('tstatus')) {
            $transactionsQuery->where('status', $request->tstatus);
        }

        $transactions = $transactionsQuery
            ->latest()
            ->paginate($perPage);

        // AJAX response
        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.payment.partials.transactions-table', compact('transactions'))->render()
            ]);
        }

       

        $transStat = Transaction::all('status');
        // $checkOuts = CheckoutRequest::with('agent')->paginate(5)->where('request_status','pending');

        $monthlyTransactions = Transaction::select(
                                DB::raw("strftime('%m', created_at) as month"),
                                DB::raw('COUNT(*) as count'),
                                DB::raw('SUM(offer_amount) as revenue'),
                            )
                            ->whereRaw("strftime('%Y', created_at) = ?",date('Y'))
                            ->groupBy('month')
                            ->get();
        $monthlyTransactions->transform(function($item) {
            $item->month_name = date('M', mktime(0, 0, 0, $item->month, 10));
            return $item;
        });

        /**
         * total reveneu is the sum of all confirmed transactions
         * minus the sum of all approved checkouts 
         */


        $pendingTransactions = $transStat->filter(function ($trns) {
            return $trns->status == "pending";
        });

        $completedTransactions = $transStat->filter(function ($trns) {
            return $trns->status == "confirmed";
        });
        $refundIssued = $transStat->filter(function ($trns) {
            return $trns->status == "refunded";
        });

        // dd($monthlyTransactions,);

        return view('admin.payment.index',[
            'monthlyTransactions' => $monthlyTransactions,
            'transactions' => $transactions,
            'checkOuts' => $checkOuts,
            'pendingTransactions' => count($pendingTransactions),
            'completedTransactions' => count($completedTransactions),
            'refundIssued' => count($refundIssued),
        ]);
    }

    
    public function approveCheckout(CheckoutRequest $checkout)
    {
        // Policy check
        // $this->authorize('update', $checkout);

        $checkout->update([
            'request_status' => 'approved'
        ]);

        return response()->json([
            'success' => true,
            'new_status' => 'approved'
        ]);
    }

    // Reject checkout request
    public function rejectCheckout(CheckoutRequest $checkout)
    {
        // Optional: Policy check
        // $this->authorize('update', $checkout);

        $checkout->update([
            'request_status' => 'rejected'
        ]);

        return response()->json([
            'success' => true,
            'new_status' => 'rejected'
        ]);
    }
}
