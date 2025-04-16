<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Taste extends Model implements TranslatableContract
{
    use Translatable;
    use  Notifiable;
    public $translatedAttributes = ['taste'];

    protected $hidden = [
        'translations',
        "created_at",
        "deleted_at",
    ];




}
