<?php
namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;

class UserService{
    public function __construct(
        private UserRepositoryInterface $userRepository,
    )
    {   
    }
    public function find(int $userId)
    {
        return $this->userRepository->find($userId);
    }
    public function sent(int $userId)
    {
        return $this->userRepository->sent($userId);
    }
    public function received(int $userId)
    {
        return $this->userRepository->received($userId);
    }
    public function allUsers()
    {
        return $this->userRepository->allUsers();
    }
    public function avgDonationReceived(int $userId)
    {
        return $this->userRepository->avgDonationReceived($userId);
    }
}