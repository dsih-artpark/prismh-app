<?php




namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Customerotp extends Authenticatable
{
    use Notifiable;

    protected $table = 'customer_otp';
    // protected $guarded = array();
}