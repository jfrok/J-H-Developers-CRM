<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\Notification;
use App\Models\Project;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
        view()->share('notis', Notification::all());
        view()->share('customerQ', Customer::latest()->paginate(5));
        view()->share('projectQ', Project::latest()->paginate(5));
        Paginator::useBootstrapFour();
    }

}
