<?php

namespace App\Providers;

use App\Models\User;
use App\View\Components\agent_dashboard\CheckOutRequestTable;
use App\View\Components\agent_dashboard\TransactionTable;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Blade::component(
            'agent_dashboard.check-out-request-table',
            CheckOutRequestTable::class
        );
        Blade::component(
            'agent-dashboard.transaction-table', 
            TransactionTable::class
        );
        Gate::define('isAdmin', function (User $user) {
            return $user->role === 'admin';
        });
    }
}
