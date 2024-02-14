<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Condivide la variabile $notifications con tutte le viste
        view()->composer('*', function ($view) {
            $notifications = Notification::paginate(10);
            $view->with('notifications', $notifications);
        });
    }
}
