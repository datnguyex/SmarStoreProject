<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = "order_details";
    protected $primaryKey = "id";
    public $timestamps = true;
    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    //nối bảng 
    public function Product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    //định nghĩa
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'seller_id',
        'price',
        'total',
    ]; 
}