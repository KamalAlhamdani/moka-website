<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'text', 'attachment','user_id'
    ];
    protected $hidden = [
        'user_id',
        "updated_at",
        "deleted_at",
    ];

}
