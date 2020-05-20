<?php

namespace WGT\Providers;

use DB;
use Illuminate\Support\ServiceProvider;
use Log;

class DbLogProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        if (!config('app.debug')) {
            return;
        }

        DB::listen(function ($query) {
            Log::info($query->sql, $query->bindings, $query->time);
        });

    }
}
