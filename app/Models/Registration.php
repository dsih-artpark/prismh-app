<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'time_stamp',
        'email',
        'doj',
        'first_name',
        'last_name',
        'emp_id',
        'address',
        'address2',
        'city',
        'state',
        'pincode',
        'landmark',
        'mobile',
        'alt_mobile'
    ];
}