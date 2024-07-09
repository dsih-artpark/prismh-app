<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Division extends Model implements Auditable
{
    use AuditableTrait;
    
    protected $table = "division";

    protected $fillable = ['name', 'zone_id', 'latitude', 'longitude'];
    
    public $timestamps = false;

    public function zone(){
      return $this->belongsTo(\App\Models\Zone::class, 'zone_id');
    }
}

?>