<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Country extends Authenticatable
{
    use Notifiable;

    protected $table = 'pwa_country';
    // protected $guarded = array();
}