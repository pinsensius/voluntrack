<?php

namespace App\Providers;

use App\Models\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Midtrans\Config;

class AppServiceProvider extends ServiceProvider
{
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
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
        Route::bind('event', function ($value) {
            return Event::where('id_event', $value)->firstOrFail();
        });
    }
}
