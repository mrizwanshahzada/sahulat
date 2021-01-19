<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Vendor;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);

        view()->composer('backend.partials._sidebar', function ($view) {
            $vendor_requests = Vendor::where('status', 'Pending')->count();
            $view->with('vendor_requests', $vendor_requests);
        }
        );

        view()->composer('frontend.vendor.dashboard.partials._sidebar', function ($view) {
            $id = Auth::user()->vendor->id;
            $vendor_pending_task = Task::where('status', 'Pending')->where('vendor_id', $id)->count();
            $vendor_cancel_task = Task::where('status', 'Canceled')->where('vendor_id', $id)->count();
            $vendor_complete_task = Task::where('status', 'Completed')->where('vendor_id', $id)->count();
            $vendor_current_task = Task::where('status', 'In Progress')->where('vendor_id', $id)->count();
            $vendor_assigned_task = Task::where('status', 'Assigned')->where('vendor_id', $id)->count();
            $vendor_verifying_task = Task::where('status', 'Verifying')->where('vendor_id', $id)->count();
            $view->with('data', ['vendor_pending_task'=>$vendor_pending_task, 'vendor_cancel_task'=>$vendor_cancel_task, 'vendor_complete_task'=>$vendor_complete_task, 'vendor_current_task'=>$vendor_current_task, 'vendor_assigned_task'=>$vendor_assigned_task, 'vendor_verifying_task'=>$vendor_verifying_task]);
        }
        );




    }
}
