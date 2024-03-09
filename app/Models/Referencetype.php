<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Referencetype extends Authenticatable
{
    use Notifiable;

    protected $table = 'pwa_referencetype';
    // protected $guarded = array();
}