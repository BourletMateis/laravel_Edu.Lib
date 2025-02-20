<?php
namespace App\Providers;

use App\Models\Appointments;
use App\Models\Schedule;
use App\Policies\AppointmentsPolicy;
use App\Policies\ArticlePolicy;
use App\Policies\SchedulePolicy;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Policies\RolePolicy;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{

    /**
     * The model-to-policy mappings for the application.
     *
     * @var array
     */



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
        Gate::policy(Schedule::class, SchedulePolicy::class);
        Gate::policy(Appointments::class, AppointmentsPolicy::class);
    }
}
