<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Gallery extends Authenticatable
{
    use Notifiable;

    protected $table = 'pwa_gallery';
    // protected $guarded = array();
}