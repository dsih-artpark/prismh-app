<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Submodule extends Authenticatable
{
    use Notifiable;

    protected $table = 'submodules';
    // protected $guarded = array();
}