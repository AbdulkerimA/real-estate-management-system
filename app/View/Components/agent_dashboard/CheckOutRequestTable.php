<?php

namespace App\View\Components\agent_dashboard;

use App\Models\CheckoutRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class CheckOutRequestTable extends Component
{
    public $checkOutReq;

    public function __construct()
    {
        // dd('component class loaded');
        $agentId = Auth::user()->agentProfile->id;
    
        $query = CheckoutRequest::where('agent_id', $agentId);

        // 🔍 Search
        if (request()->filled('search')) {
            $search = request('search');

            $query->where(function ($q) use ($search) {
                $q->where('requested_amount', 'like', "%{$search}%")
                  ->orWhere('request_status', 'like', "%{$search}%");
            });
        }

        // 📌 Status filter
        if (request()->filled('status') && request('status') !== 'all') {
            $query->where('request_status', request('status'));
        }

        $this->checkOutReq = $query
            ->latest()
            ->paginate(5)
            ->withQueryString();

        // dd($this->checkOutReq);
    }

    public function render()
    {
        return view('components.agent_dashboard.check-out-request-table');
    }
}
