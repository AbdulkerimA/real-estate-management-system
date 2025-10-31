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

        $transactions = Transaction::with(['buyer','agent','property'])->paginate($perPage);
        $checkOuts = CheckoutRequest::with('agent')->paginate(5)->where('request_status','pending');

        $monthlyTransactions = Transaction::select(
                                DB::raw('YEAR(created_at) as year'),
                                DB::raw('MONTH(created_at) as month'),
                                DB::raw('COUNT(*) as count'),
                            );

        // dd($monthlyTransactions);

        return view('admin.payment.index',[
            'monthlyTransactions' => $monthlyTransactions,
            'transactions' => $transactions,
            'checkOuts' => $checkOuts,
        ]);
    }
}
