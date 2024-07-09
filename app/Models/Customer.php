<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Customer extends Authenticatable implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $table = 'customers';
     protected $guard = 'customer';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = ['phone', 'password', 'id_card','username', 'address', 'status', 'zone_ids',
                           'email', 'roles', 'reg_id', 'ward', 'profile', 'division_ids', 'ward_ids'];

    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function getAuthPassword(){
        return $this->password;
    }
    public function role(){
      return $this->hasOne(Role::class, 'id', 'roles');
    }
    public function user_ward(){
      return $this->hasOne(Ward::class, 'id', 'ward');
    }
}