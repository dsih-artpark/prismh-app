<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Department extends Authenticatable
{
    use Notifiable;

    protected $table = 'pwa_department';
    // protected $guarded = array();
}