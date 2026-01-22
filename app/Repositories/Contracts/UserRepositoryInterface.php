<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function find(int $userId);
    public function sent(int $userId);
    public function received(int $userId);
    public function allUsers();
    public function avgDonationReceived(int $userId);
}
