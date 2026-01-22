<?php

namespace App\Repositories\Contracts;

interface BalanceRepositoryInterface
{
    public function newBalanceDonor(int $donationValue, int $donorId);
    public function newBalanceDonee(int $donationValue, int $doneeId);
    public function find(int $userId);
    public function moreBalance();
    public function userMoreBalance();
}
