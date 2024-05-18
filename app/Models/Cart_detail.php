<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart_detail extends Model
{
    use HasFactory;

    protected $table = 'cart_detail';


    public function product_cart() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
    ]; 


    // public function user_cart() {
    //     return $this->belongsTo(Customer::class, 'product_id', 'id');
    // }
}
