<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Activities extends Authenticatable
{
    use Notifiable;

    protected $table = 'pwa_activities';
    // protected $guarded = array();
}