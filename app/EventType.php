<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Notifications\Notifiable;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;


class EventType extends Model implements TranslatableContract
{
    use Translatable;
    
   
    use  Notifiable;

    use SoftDeletes;

    public $translatedAttributes = ['name','notification_title','notification_message','notification_image'];
    
    protected $hidden = [
        "created_at",
        "updated_at",
        "deleted_at",
        'translations'
    ];

    public function Products()
    {
        return $this->belongsToMany('App\product');
    }

    //
}
