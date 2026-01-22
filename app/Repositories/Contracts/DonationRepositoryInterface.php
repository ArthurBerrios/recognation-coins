<?php

namespace App\Repositories\Contracts;

interface DonationRepositoryInterface
{
    public function totalDonations();
    public function largestDonor();
}
