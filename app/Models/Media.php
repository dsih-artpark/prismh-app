<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Media extends Authenticatable
{
    use Notifiable;

    protected $table = 'media';
    // protected $guarded = array();
}