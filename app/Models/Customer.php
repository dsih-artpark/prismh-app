<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory;

    protected $table = 'customers';
     protected $guard = 'customer';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = ['phone', 'password'];

    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function getAuthPassword(){
        return $this->password;
    }
}