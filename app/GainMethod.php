<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GainMethod extends Model
{
    public $with = ['GainType'];

    public function GainType()
    {
        //return $this->hasManyThrough('App\GainType','App\GainMethod' );
        return $this->belongsTo('App\GainType');
    }
}
