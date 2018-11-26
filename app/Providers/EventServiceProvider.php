<?php

namespace App\Providers;

use App\Events\OrderReviewd;
use App\Listeners\UpdateProductRating;
use App\Events\OrderPaid;
use App\Listeners\UpdateProductSoldCount;
use App\Listeners\SendOrderPaidMail;
use App\Listeners\RegisteredListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            RegisteredListener::class,
        ],
        OrderPaid::class => [
            UpdateProductSoldCount::class,
            SendOrderPaidMail::class,
        ],
        OrderReviewd::class => [
            UpdateProductRating::class,
        ],
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            // add your listeners (aka providers) here
            'SocialiteProviders\Weixin\WeixinExtendSocialite@handle',
            'SocialiteProviders\Line\LineExtendSocialite@handle',
        ],
        'eloquent.created: Illuminate\Notifications\DatabaseNotification' => [
            'App\Listeners\PushNotification',
        ],
        'Illuminate\Database\Events\QueryExecuted' => [
            'App\Listeners\QueryLogTrackerListener',
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
