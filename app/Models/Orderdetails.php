<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderdetails extends Model
{
    use HasFactory;

    protected $table = 'order';
    
    protected $fillable = [
        'reg_id',
        'order_priority',
        'ordered_date',
        'accepted_date',
        'packed_date',
        'shipped_date',
        'tracking_date',
        'delivered_date',
        'labeled_date'
    ];

    // public function registration()
    // {
    //     return $this->hasMany(Registration::class);
    // }
   
}