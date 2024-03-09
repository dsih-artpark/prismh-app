<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Support extends Authenticatable
{
    use Notifiable;

    protected $table = 'pwa_support';
    // protected $guarded = array();
}