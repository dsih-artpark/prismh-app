<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class News extends Authenticatable
{
    use Notifiable;

    protected $table = 'pwa_news';
    // protected $guarded = array();
}