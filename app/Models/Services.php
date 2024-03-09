<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Services extends Authenticatable
{
    use Notifiable;

    protected $table = 'pwa_services';
    // protected $guarded = array();
}