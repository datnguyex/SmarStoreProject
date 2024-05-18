<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Product as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory;

    //moi san pham thuoc ve 1 danh muc , duoc lien ket qua category_id , va khoa chinh cung la 'category_id'
   
    protected $table = 'tbl_products';
    protected $primaryKey = 'id';
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function product() {
        return $this->belongsTo(OrderDetail::class, 'id', 'product_id');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id', 'id');
    }

    public function product_cart() {
        return $this->belongsTo(Cart_detail::class, 'id', 'product_id');
    }

   
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'id',
        'product_name',
        'description',
        'price',
        'quantity',
        'img',
        'sold',
        'category_id',
        'seller_id',
      
    ];
     /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
      /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
