<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Ip;

class IpServiceProvider extends ServiceProvider
{
    protected $defer = true;
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //View::share('ip_location', $ip_location);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Ip', function ($app) {
            return new Ip();
          });
       /*
        \App::singleton('App\Ip', function(){
            return new \App\Billing\Stripe(config('services.stripe.secret'));
          });
          ***/
          //$stripe=App::make('App\Billing\Stripe');
    }
}
