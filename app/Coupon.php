<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $hidden = [
        'status',
        'uses_status',
        'coupon_types_id',
        'note',
        'translations',
        "created_at",
        "updated_at",
        "deleted_at",
    ];
}
