<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $fillable = [
        'price_at_time','quantity','product_id','order_id','total','size'
    ];
    function products(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    function orders(){
        return $this->belongsTo(Order::class);
    }
}
