<?php
namespace App\Repositories;

use App\Models\Donation;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface  {

    public function __construct(
    
    ){

    }

    public function find(int $userId)
    {
        return User::where('id', '=' , $userId)->first();
    }
    public function sent(int $userId)
    {
        return Donation::where('donor','=',$userId)->count();
    }
    public function received(int $userId)
    {
        return Donation::where('donee','=',$userId)->count();
    }
    public function allUsers()
    {
        return User::all();
    }
    public function avgDonationReceived(int $userId)
    {
        $media = Donation::select(DB::raw('avg(value) as media'))->where('donor','=',$userId)->first();

        return round($media->media);
    }
}
