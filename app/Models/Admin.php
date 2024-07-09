<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Admin extends Authenticatable implements Auditable
{
    use Notifiable, HasFactory, AuditableTrait;
    
    protected $table = 'pwa_admin';
    
    protected $primaryKey = 'admin_id';

    protected $guard = 'admin';

    protected $hidden = [
      'password',
      'remember_token',
    ];

    protected $fillable = ['name','email','phone','password','image',
                          'address','city','country','pin'];
    
}