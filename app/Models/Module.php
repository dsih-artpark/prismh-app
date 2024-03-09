<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Module extends Authenticatable
{
    use Notifiable;

    protected $table = 'modules';
    // protected $guarded = array();
}