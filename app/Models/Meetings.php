<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Meetings extends Authenticatable
{
    use Notifiable;

    protected $table = 'pwa_meetings';
    // protected $guarded = array();
}