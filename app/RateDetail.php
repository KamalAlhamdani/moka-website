<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RateDetail extends Model
{
    protected $fillable = [
        'rate_id','rate_type_id','rate'
    ];

}
