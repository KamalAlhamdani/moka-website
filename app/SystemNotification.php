<?php

namespace App;

use Illuminate\Notifications\DatabaseNotification;

class SystemNotification extends DatabaseNotification
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'system_notifications';
}
