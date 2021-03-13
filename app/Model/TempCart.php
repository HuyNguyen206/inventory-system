<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class TempCart extends Model
{
    //
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

}
