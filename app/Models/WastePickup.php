<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WastePickup extends Model
{
  protected $table = 'pick';

  protected $fillable = ['uid', 'cust_id', 'waste', 'indoor', 'outdoor', 'image_data', 'latit', 'descp', 'status',
                         'zone','phone','division','ward','q1','source_reduction','source_reduction_img','created_at'];
  
  public $timestamps = false;
}
?>