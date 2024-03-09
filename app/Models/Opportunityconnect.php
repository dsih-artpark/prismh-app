<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Opportunityconnect extends Authenticatable
{
    use Notifiable;

    protected $table = 'pwa_opportunityconnect';
    // protected $guarded = array();
}