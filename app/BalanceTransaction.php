<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BalanceTransaction extends Model
{
    protected $fillable = [
        'request_id', 'user_wallet_id', 'branch_id','amount','type'
    ];

    protected $hidden = [
        'user_id',
        'created_at',
        "updated_at",
        "deleted_at",
         "id",
        "note",
        "user_wallet_id",
        "request_id",
        "branch_id",
    ];


}
