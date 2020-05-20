<?php

namespace WGT\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \WGT\Events\ExampleEvent::class => [
            \WGT\Listeners\ExampleListener::class,
        ],
    ];
}
