<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDonation extends Model
{
    protected $table = 'users-donations';
    protected $fillable = [
        'user_id',
        'donation_id'
    ];

}
