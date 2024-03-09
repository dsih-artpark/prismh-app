<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class About extends Authenticatable
{
    use Notifiable;

    protected $table = 'pwa_about';
    // protected $guarded = array();
}