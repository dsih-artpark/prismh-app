<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Opportunity extends Authenticatable
{
    use Notifiable;

    protected $table = 'opportunity';
    // protected $guarded = array();
}