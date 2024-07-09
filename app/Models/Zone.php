<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Zone extends Model implements Auditable
{
    use AuditableTrait;
    protected $table = 'zone';

    protected $fillable = ['title', 'latitude', 'longitude'];
    
    public $timestamps = false;
}