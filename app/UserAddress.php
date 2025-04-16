<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class UserAddress extends Model
{

    use SoftDeletes;
    
    protected $fillable = [
        'name', 'desc', 'lat','long','user_id'
    ];

    protected $hidden = [
        'user_id',
        'created_at',
        "updated_at",
        "deleted_at",
        'status',

    ];
}
