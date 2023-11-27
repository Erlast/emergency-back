<?php

namespace App\Providers;

use App\Services\JwtTokenService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(JwtTokenService::class, function () {
            return new JwtTokenService(
                env('JWT_SECRET', 'secret'),
                config('app.url')
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
