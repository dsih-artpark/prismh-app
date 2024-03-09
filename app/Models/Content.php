<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Content extends Authenticatable
{
    use Notifiable;

    protected $table = 'pwa_content';
    // protected $guarded = array();
}