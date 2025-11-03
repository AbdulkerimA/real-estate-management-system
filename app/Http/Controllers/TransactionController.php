<?php

namespace App\Http\Controllers;

use App\Models\CheckoutRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(){
        $perPage = request()->get('per_page') ?? 5;

        $transactions = Transaction::with(['buyer','agent','property']);
        $transStat = Transaction::all('status');
        $checkOuts = CheckoutRequest::with('agent')->paginate(5)->where('request_status','pending');

        $monthlyTransactions = Transaction::select(
                                DB::raw("strftime('%m', created_at) as month"),
                                DB::raw('COUNT(*) as count'),
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

        // dd($pendingTransactions,);

        return view('admin.payment.index',[
            'monthlyTransactions' => $monthlyTransactions,
            'transactions' => $transactions->paginate($perPage),
            'checkOuts' => $checkOuts,
            'pendingTransactions' => count($pendingTransactions),
            'completedTransactions' => count($completedTransactions),
            'refundIssued' => count($refundIssued),
        ]);
    }
}
