<?php
namespace App\Repositories;

use App\Models\Donation;
use App\Repositories\Contracts\DonationRepositoryInterface;
use Illuminate\Support\Facades\DB;

class DonationRepository implements DonationRepositoryInterface{
    public function totalDonations()
    {
        return Donation::count();
    }
    public function largestDonor()
    {
        return Donation::select('name')
            ->join('users', 'users.id' , '=', 'donations.donor')
            ->orderbyDesc(DB::raw('count(donations.donor)'))
            ->groupBy('users.id')
            ->limit(1)
            ->first();
    }
}