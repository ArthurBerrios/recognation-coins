<?php

namespace App\Providers;

use App\Models\Donation;
use App\Models\User;
use App\Observers\DonationObserver;
use App\Observers\UserObserver;
use App\Repositories\BalanceRepository;
use App\Repositories\Contracts\BalanceRepositoryInterface;
use App\Repositories\Contracts\DonationRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\DonationRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            BalanceRepositoryInterface::class,
            BalanceRepository::class
        );
        $this->app->bind(
            UserRepositoryInterface::class, 
            UserRepository::class
        );
        $this->app->bind(
            DonationRepositoryInterface::class,
            DonationRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Donation::observe(DonationObserver::class);
    }
}
