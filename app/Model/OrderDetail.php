<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
    protected $guarded = [];
    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }

    function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
