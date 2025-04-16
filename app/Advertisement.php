<?php

namespace App;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Advertisement extends Model implements TranslatableContract
{
    use Translatable;


    use Notifiable;



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $appends = ['image_path'];
    public $translatedAttributes = ['image','desc'];

    protected $hidden = [
        'translations',
        "created_at",
        "updated_at",
    ];

    /**
     * This function used in 
     * Advertisement model to get image path by
     * public $appends = ['image_path']
     * 
     * @return URL
     */
    public function getImagePathAttribute()
    {
        //BySwadi: change the path of redirected image 
        //from the domain of control panel
        return domainAsset('storage/'.$this->image);
    }

}
