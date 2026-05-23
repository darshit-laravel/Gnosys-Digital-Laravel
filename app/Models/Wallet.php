<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $guarded = [];

    public function histories()
    {
        return $this->hasMany(WalletHistory::class, 'wallet_id');
    }
}
