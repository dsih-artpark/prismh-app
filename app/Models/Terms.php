<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Terms extends Authenticatable
{
    use Notifiable;

    protected $table = 'pwa_terms';
    // protected $guarded = array();
}