<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Modules extends Authenticatable
{
    use Notifiable;

    protected $table = 'modules';
    // protected $guarded = array();
}