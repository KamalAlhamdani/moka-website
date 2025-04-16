<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = [
        'comment', 'request_id','carrier_id','user_id'
    ];
    protected $hidden = [
        "updated_at",
        "deleted_at",
    ];

    public function rates()
    {
        return $this->hasMany('App\RateDetails');
    }
}
