<?php

namespace App\Providers;

use App\Repositories\Auth\AuthInerface;
use App\Repositories\Auth\AuthService;
use App\Repositories\User\UserRepoInterface;
use App\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthInerface::class, AuthService::class);
        $this->app->bind(UserRepoInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
