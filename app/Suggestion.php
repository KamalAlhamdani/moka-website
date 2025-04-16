<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    protected $fillable = [
        'text', 'image','user_id'
    ];
    protected $hidden = [
        'user_id',
        "updated_at",
        "deleted_at",
    ];
}
