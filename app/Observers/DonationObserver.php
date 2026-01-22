<?php

namespace App\Observers;

use App\Models\Donation;
use App\Models\User;
use App\Services\BalanceService;
use App\Services\UserService;

class DonationObserver
{
    public function __construct(
        private BalanceService $balanceService,
    )
    {
    }
    /**
     * Handle the Donation "created" event.
     */
    public function created(Donation $donation): void
    {
        $donorId = $donation->donor;   
        $this->balanceService->newBalanceDonor($donation->value, $donorId);

        $doneeId = $donation->donee;
        $this->balanceService->newBalanceDonee($donation->value, $doneeId);


    }

    /**
     * Handle the Donation "updated" event.
     */
    public function updated(Donation $donation): void
    {
        //
    }

    /**
     * Handle the Donation "deleted" event.
     */
    public function deleted(Donation $donation): void
    {
        //
    }

    /**
     * Handle the Donation "restored" event.
     */
    public function restored(Donation $donation): void
    {
        //
    }

    /**
     * Handle the Donation "force deleted" event.
     */
    public function forceDeleted(Donation $donation): void
    {
        //
    }
}
