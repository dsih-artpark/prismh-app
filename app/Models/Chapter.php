<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Chapter extends Authenticatable
{
    use Notifiable;

    protected $table = 'pwa_chapter';
    // protected $guarded = array();
}