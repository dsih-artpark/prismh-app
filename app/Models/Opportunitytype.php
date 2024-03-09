<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Opportunitytype extends Authenticatable
{
    use Notifiable;

    protected $table = 'pwa_opportunitytype';
    // protected $guarded = array();
}