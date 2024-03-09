<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Complaints extends Authenticatable
{
    use Notifiable;

    protected $table = 'complaints';
    // protected $guarded = array();
}