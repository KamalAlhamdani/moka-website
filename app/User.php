<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laravel\Passport\HasApiTokens;

use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'phone',
        'birth_date',
        'address',
        'points_account_num',
        'parent_points_account_num'
    ];

    protected $with = ['wallet'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'deleted_at',
        'image',
        'created_at',
        'updated_at'
    ];

    public $appends = ['image_path', 'status_message'];

    /**
     * Get Image Path Attribute
     *
     * @return void
     */
    public function getImagePathAttribute()
    {
        return domainAsset('storage/'.$this->image);
    }

    /**
     * Get Status Message Attribute
     *
     * @return void
     */
    public function getStatusMessageAttribute()
    {
        $statuses = [
            0 => app()->getLocale()== 'en'?'This account is attitude' : 'هذا الحساب موقف',
            1 => app()->getLocale()== 'en'?'This account is active' : 'هذا الحساب فعال',
            2 => app()->getLocale()== 'en'?'This account is deleted' : 'هذا الحساب محذوف',
            3 => app()->getLocale()== 'en'?'This account is in blacklist' : 'هذا الحساب في القائمة سوداء',
        ];

        return $statuses[$this->status];
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'date'
    ];

   // protected $with=['favorite'];

    public function favorite()
    {
        return $this->belongsToMany('App\Product','user_favorites')->using('App\UserFavorite');
    }
    public function address()
    {
        return $this->hasMany('App\UserAddress');
    }

    public function request()
    {
        return $this->hasManyThrough('App\Request', 'App\Cart');
       // return $this->hasMany('App\Request')->using('App\UserFavorite');
    }

    public function pointHistory()
    {
        return $this->hasMany('App\PointHistory');
       // return $this->hasMany('App\Request')->using('App\UserFavorite');
    }

    public function wallet()
    {
        return $this->hasOne('App\userWallet');
       // return $this->hasMany('App\Request')->using('App\UserFavorite');
    }
}
