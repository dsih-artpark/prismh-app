<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Nature extends Authenticatable
{
    use Notifiable;

    protected $table = 'pwa_nature';
    // protected $guarded = array();
}