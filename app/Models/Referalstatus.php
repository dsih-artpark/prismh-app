<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Referalstatus extends Authenticatable
{
    use Notifiable;

    protected $table = 'pwa_referalstatus';
    // protected $guarded = array();
}