<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Subcategory extends Authenticatable
{
    use Notifiable;

    protected $table = 'pwa_subcategory';
    // protected $guarded = array();
}