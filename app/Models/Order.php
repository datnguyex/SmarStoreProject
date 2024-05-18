<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    //định nghĩa
    protected $table = "orders";
    protected $primaryKey = "id";
    public $timestamps = true;
    //mối quan hệ
    public function orders()
    {
        return $this->belongsTo(OrderDetail::class, 'id', 'id');
    }
    
    protected $fillable = [
        'customer_id', 
        'TotalAmount',
        'PaymentMethod',
        'PaymentStatus',
    ];

}