<?php
namespace App\Services;

use App\Repositories\Contracts\DonationRepositoryInterface;

class DonationService{
    public function __construct(
        private DonationRepositoryInterface $donationRepository,
    )
    {
    }
    public function totalDonations()
    {
        return $this->donationRepository->totalDonations();
    }
    public function largestDonor()
    {
        return $this->donationRepository->largestDonor();
    }
}