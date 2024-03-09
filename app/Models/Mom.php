<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Mom extends Authenticatable
{
    use Notifiable;

    protected $table = 'pwa_meetings_mom';
    // protected $guarded = array();
}