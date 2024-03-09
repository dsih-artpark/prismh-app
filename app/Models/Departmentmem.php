<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Departmentmem extends Authenticatable
{
    use Notifiable;

    protected $table = 'pwa_department_mem';
    // protected $guarded = array();
}