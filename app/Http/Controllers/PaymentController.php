<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Cart_detail;
use App\Models\CustomerUser;

class PaymentController extends Controller
{
    //
    public function index() {
        session_start();
        $user_id = $_SESSION['user_id'];
        $user = CustomerUser::find($user_id)->first();
        //bỏ session ở đây để chọn ra cart_detail
        // Lấy giá trị của cookie "carts" từ $_COOKIE
        $cookieValue = isset($_COOKIE['carts']) ? $_COOKIE['carts'] : '';
        
        // Sử dụng json_decode để chuyển đổi giá trị từ chuỗi JSON thành một mảng PHP
        $arrayCart = json_decode($cookieValue, true);

        if($arrayCart == null) {
            return redirect("cart");
        }
        
        $cart = Cart::where('user_id',$user_id)->first();
        $total = 0;
        $product_cart = [];
        foreach($arrayCart as $index => $cart_detail_id) {
            $cart_detail = Cart_detail::with('product_cart')
            ->where('cart_id', $cart->id)
            ->where('id', $cart_detail_id)
            ->first();
            $product_cart[$index] = $cart_detail;
            $total += $cart_detail->quantity * $cart_detail->product_cart->price;
        } 
        return view('carts.payment', [
            'cart_detail' => $product_cart,
            'total' => $total,
        ]);
    }
}