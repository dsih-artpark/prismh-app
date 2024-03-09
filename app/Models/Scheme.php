<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Scheme extends Authenticatable
{
    use Notifiable;

    protected $table = 'pwa_scheme';
    // protected $guarded = array();
}