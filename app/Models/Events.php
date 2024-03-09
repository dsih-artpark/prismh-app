<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Events extends Authenticatable
{
    use Notifiable;

    protected $table = 'pwa_events';
    // protected $guarded = array();
}