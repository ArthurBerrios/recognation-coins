<?php
namespace App\Repositories;

use App\Models\Balance;
use App\Repositories\Contracts\BalanceRepositoryInterface;
use App\Services\UserService;

class BalanceRepository implements BalanceRepositoryInterface{
    public function __construct(
        private UserService $userService,
        )
    {
    }
    public function find(int $userId){
        return Balance::where('user_id','=', $userId)->first();
    }
    public function newBalanceDonee(int $donationValue, int $doneeId)
    {
        $userDonee = $this->userService->find($doneeId);
        $newBalance = $userDonee->balance->value + $donationValue;

        return $userDonee->balance->update(['value' => $newBalance]);
    }
    public function newBalanceDonor(int $donationValue, int $donorId)
    {
        $userDonor = $this->userService->find($donorId);
        $newBalance = $userDonor->balance->value - $donationValue;

        return $userDonor->balance->update(['value' => $newBalance]);
    }
    public function moreBalance()
    {
        return Balance::select('value')->orderbyDesc('value')->first();
    }
    public function userMoreBalance()
    {
        return Balance::select('name')
            ->join('users', 'users.id', '=', 'balances.user_id')
            ->orderbyDesc('value')
            ->first();
    }
}