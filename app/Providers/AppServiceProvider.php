<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
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
        //this will use the application to use https instead of http when we are in production we should set APP_ENV in .env in production mode to production
        if(config('app.env') === 'production') {//basically if app_env is not local https will be enforced
            URL::forceScheme('https');
        }
    }
}
