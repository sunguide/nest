<?php

namespace App\Providers;

use Overtrue\EasySms\EasySms;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvicer extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(EasySms::class, function ($app) {
            return new EasySms(config('sms'));
        });

        $this->app->alias(EasySms::class, 'sms');
    }
}
