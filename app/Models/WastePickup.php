<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class WastePickup extends Authenticatable
{
    use Notifiable;

    protected $table = 'pick';
}
?>