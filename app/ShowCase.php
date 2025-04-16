<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShowCase extends Model
{
    use SoftDeletes;

    public $appends = ['image_path'];

    public  function getImagePathAttribute()
    {
        return domainAsset('storage/'.$this->image);
    }
}
