<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function order_details()
    {
        return $this->hasMany(Orderdetails::class, 'id');
    }
    public function destination_details()
    {
        return $this->hasMany(Orderdetails::class, 'id');
    }
    public static function pushorders($id)
    {
        $order_det = Order::with('destination_details')->where('id', $id)->first()->toArray();
        dd($order_det);die;
    }
}