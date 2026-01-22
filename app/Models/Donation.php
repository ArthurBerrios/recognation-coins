<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'value',
        'donor',
        'reason',
        'donee'
    ];

    public function donorUser(){
        return $this->belongsTo(User::class, 'donor');
    }
    public function doneeUser()
    {
        return $this->belongsTo(User::class, 'donee');
    }
}
