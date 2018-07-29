<?php

namespace App\Providers;
use App\Models\User;
use App\Models\Store\Order;
use App\Policies\OrderPolicy;
use App\Models\UserAddress;
use App\Policies\UserAddressPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        UserAddress::class => UserAddressPolicy::class,
        Order::class       => OrderPolicy::class,
        User::class  => \App\Policies\UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
//        \Horizon::auth(function ($request) {
//            // 是否是站长
//            return \Auth::user()->hasRole('Founder');
//        });
    }
}
