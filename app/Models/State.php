<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class State extends Authenticatable
{
    use Notifiable;

    protected $table = 'pwa_state';
    // protected $guarded = array();
}