<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Notifications\Notifiable;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Category extends model implements TranslatableContract
{
    use Translatable;

    use Notifiable;

    use SoftDeletes;

    /**
     * BySwadi
     *  */
    protected $appends = ['image_url'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $translatedAttributes = ['name','details','image'];
   // protected $fillable = ['name,	status'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'status',
        'translations',
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    public function product()
    {
        return $this->hasMany('App\Product')->where('type', 'public');
    }

    // public function getProductPaginatedAttribute()
    // {
    //     //die("fff");
    //     return $this->product()->paginate(10);
    // }


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'date'
    ];


    /**
     * Get Iamge
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        return domainAsset($this->image);
    }
}
