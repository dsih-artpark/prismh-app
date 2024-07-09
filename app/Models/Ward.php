<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Ward extends Model implements Auditable
{
    use AuditableTrait;
    
    protected $table = "ward";

    protected $fillable = ['name', 'division_id','number'];
    
    public $timestamps = false;

    public function division(){
      return $this->belongsTo(\App\Models\Division::class, 'division_id');
    }
}

?>