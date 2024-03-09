<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Appversions extends Authenticatable
{
    use Notifiable;

    protected $table = 'appversions';
    // protected $guarded = array();
}