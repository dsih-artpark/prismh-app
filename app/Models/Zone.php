<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Zone extends Authenticatable
{
    use Notifiable;

    protected $table = 'zone';
    // protected $guarded = array();
}