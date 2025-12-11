<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Auth\Pages\Login as FilamentLogin;
use App\Filament\Pages\CustomLogin;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Override Filament's Login page so admin panel accepts username or email
        $this->app->bind(FilamentLogin::class, CustomLogin::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
