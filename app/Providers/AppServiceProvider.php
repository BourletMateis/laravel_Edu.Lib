<?php
namespace App\Providers;

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
    }
}
