<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Designation extends Authenticatable
{
    use Notifiable;

    protected $table = 'pwa_designation';
    // protected $guarded = array();
}