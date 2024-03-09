<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Category extends Authenticatable
{
    use Notifiable;

    protected $table = 'pwa_category';
    // protected $guarded = array();
}