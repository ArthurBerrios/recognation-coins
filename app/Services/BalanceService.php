<?php
namespace App\Services;

use App\Repositories\Contracts\BalanceRepositoryInterface;

class BalanceService{

    public function __construct(
        private BalanceRepositoryInterface $balanceRepository,
    )
    {
    
    }
    public function newBalanceDonor(int $donationValue, int $donorId)
    {
        return $this->balanceRepository->newBalanceDonor($donationValue, $donorId);
    }
    public function newBalanceDonee(int $donationValue, int $doneeId)
    {
        return $this->balanceRepository->newBalanceDonee($donationValue, $doneeId);
    }
    public function find(int $userId)
    {
        return $this->balanceRepository->find($userId);
    }
    public function moreBalance()
    {
        return $this->balanceRepository->moreBalance();
    }
    public function userMoreBalance()
    {
        return $this->balanceRepository->userMoreBalance();
    }
}