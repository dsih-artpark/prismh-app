<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Permissions extends Authenticatable
{
    use Notifiable;

    protected $table = 'permissions';
    // protected $guarded = array();
}