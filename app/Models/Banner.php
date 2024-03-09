<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Banner extends Authenticatable
{
    use Notifiable;

    protected $table = 'pwa_banner';
    // protected $guarded = array();
}