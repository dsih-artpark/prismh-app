<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class vehicle extends Authenticatable
{
    use Notifiable;

    protected $table = 'ticket_mng';
    // protected $guarded = array();
}