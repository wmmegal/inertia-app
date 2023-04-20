<?php

namespace App\Providers;

use App\Events\EndpointWentDown;
use App\Listeners\SendDownEmailNotifications;
use App\Models\Check;
use App\Models\Endpoint;
use App\Models\Site;
use App\Observers\CheckObserver;
use App\Observers\EndpointObserver;
use App\Observers\SiteObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class       => [
            SendEmailVerificationNotification::class,
        ],
        EndpointWentDown::class => [
            SendDownEmailNotifications::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Site::observe(SiteObserver::class);
        Endpoint::observe(EndpointObserver::class);
        Check::observe(CheckObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
