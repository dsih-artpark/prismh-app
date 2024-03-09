<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Role extends Authenticatable
{
    use Notifiable;

    protected $table = 'roles';
    // protected $guarded = array();
}