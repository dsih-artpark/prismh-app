<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Document extends Authenticatable
{
    use Notifiable;

    protected $table = 'pwa_document';
    // protected $guarded = array();
}