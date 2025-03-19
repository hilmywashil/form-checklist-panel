<?php

namespace App\Providers;

use App\Models\FormChecklistDaily;
use App\Models\FormChecklistPanel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrap();
        Carbon::setLocale('id');

        View::composer('*', function ($view) {
            $formpanelcount = FormChecklistPanel::count(); 
            $totalUsers = User::count(); 
            $totalformdaily = FormChecklistDaily::count(); 

            $view->with([
                'formpanelcount' => $formpanelcount,
                'totalUsers' => $totalUsers,
                'totalformdaily' => $totalformdaily,
            ]);
        });
    }
}
