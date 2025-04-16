<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Notifications\Notifiable;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;


class Unit extends Model implements TranslatableContract
{
    use Translatable;
    
   
    use  Notifiable;

    use SoftDeletes;

    public $translatedAttributes = ['name'];

    protected $hidden = [
        'translations',
        "created_at",
        "updated_at",
        "deleted_at",
    ];
}
