<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class WasteDump extends Authenticatable
{
    use Notifiable;

    protected $table = 'dump';
}
?>