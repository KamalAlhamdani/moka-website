<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\SoftDeletes;


class UserEvent extends model
{
    use Notifiable;

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','note', 'date', 'user_id','event_type_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id',
        "updated_at",
        "deleted_at",
    ];

    protected $casts = [
        'date' => 'date'
    ];

    public $with = ['eventType'];

    public function eventType()
    {
        return $this->belongsTo('App\EventType','event_type_id');
    }



}
