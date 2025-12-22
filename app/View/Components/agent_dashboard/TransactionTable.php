<?php

namespace App\View\Components\agent_dashboard;

use App\Models\Earning;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class TransactionTable extends Component
{
    public $earnings;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $agentId = Auth::user()->agentProfile->id;

        $query = Earning::where('agent_id', $agentId);

        
        if (request()->filled('search')) {
            $search = request('search');

            $query->/*whereHas('property', function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            })->*/Where('total_earnings', 'like', "%{$search}%")
              ->orWhere('commission', 'like', "%{$search}%");
        }


        $this->earnings = $query
            ->latest()
            ->paginate(5)
            ->withQueryString(); // keeps filters on pagination
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.agent_dashboard.transaction-table');
    }
}
