<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userWallet extends Model
{
    protected $fillable = [
        'openning_balance', 'current_balance', 'user_id', 'carrier_id',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'user_id',  'deleted_at', 'created_at', 'updated_at'
    ];

    public function walletTransaction()
    {
        return $this->hasMany('App\BalanceTransaction');
        // return $this->hasMany('App\Request')->using('App\UserFavorite');
    }
}
