<?php


namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\SoftDeletes;


class Carrier extends Authenticatable
{
    use HasApiTokens, Notifiable;

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','gender','phone',/* 'birth_date','address','points_account_num','parent_points_account_num' */
    ];

    //protected $with = ['wallet'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','email_verified_at','deleted_at','image','created_at','updated_at'
    ];

    public function request()
    {
        return $this->hasMany('App\Request')->whereIn('status',
        // ['requested', 'repair', 'deliver', 'delivered', 'received']
        ['requested','repair','deliver','delivered','ready','canceled','received','on_branch','on_the_way','completedRequest']
    );
       // return $this->hasMany('App\Request')->using('App\UserFavorite');
    }

    public function wallet()
    {
        return $this->hasOne('App\userWallet');
       // return $this->hasMany('App\Request')->using('App\UserFavorite');
    }

    public function pointHistory()
    {
        return $this->hasMany('App\PointHistory');
       // return $this->hasMany('App\Request')->using('App\UserFavorite');
    }

    /* public $appends = ['image_path'];

    public  function getImagePathAttribute()
    {
        return domainAsset('storage/'.$this->image);
    } */

   /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
  /*    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'date'
    ]; */
}
