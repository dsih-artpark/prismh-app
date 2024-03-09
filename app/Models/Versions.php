<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Versions extends Authenticatable
{
    use Notifiable;

    protected $table = 'versions';
    // protected $guarded = array();
}