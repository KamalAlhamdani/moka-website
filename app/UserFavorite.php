<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserFavorite extends Pivot
{
    protected $table = 'user_favorites';

    public $appends = ['user_id'];
    /**
     * User id
     *
     * @return void
     */
    public function getUserIdAttribute()
    {
        return $this->user_id;
    }

    public function users()
    {
        return $this->hasMany('App\User', 'favorite_users')->using('App\User');
    }
}
