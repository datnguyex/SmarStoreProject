<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Cart_detail;

class CartController extends Controller
{
    //
    public function index() {
        session_start();
        if(!empty($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $cart = Cart::where('id', $user_id)->first();
            $cart_detail = Cart_detail::with('product_cart')
            ->where('cart_id', $cart->id)->get();
            $total = 0;
            foreach($cart_detail as $cart_product) {
                $total += $cart_product->quantity * $cart_product->product_cart->price;
            }
            return view('carts.cart', [
                'cart_detail' => $cart_detail,
                'total' => $total,
            ]);
        }
        else {
            return redirect("home")->with('login', true);
        }
    }

    //
    public function addToCart() {
        session_start();
        $user_id = $_SESSION['user_id'];
        $data = request('data');
        $arrayIdWithQuantity = json_decode($data, true);
        $cart = Cart::where('id', $user_id)->first();
        if($cart == null) {
            $cart = Cart::create([
                'user_id' => $user_id,
            ]);
        }
        if($cart) {
            $cart_detail = Cart_detail::create([
                'cart_id' => $cart->id,
                'product_id' => $arrayIdWithQuantity[1],
                'quantity' => $arrayIdWithQuantity[0],
            ]);
        }

        $count_cart = Cart_detail::where('cart_id', $cart->id)->count();
        return $count_cart ;
    }

    public function addQuantity() {
        $data = request('data');
        $cartIdWithQuantity = json_decode($data, true);
        $cart_detail = Cart_detail::where('id', $cartIdWithQuantity[0])->first();
        $cart_detail->quantity = $cartIdWithQuantity[1];
        $cart_detail->save();
        return $cart_detail->quantity ;
    }   

    public function subQuantity() {
        $data = request('data');
        $cartIdWithQuantity = json_decode($data, true);
        $cart_detail = Cart_detail::where('id', $cartIdWithQuantity[0])->first();
        $cart_detail->quantity = $cartIdWithQuantity[1];
        $cart_detail->save();
        return $cart_detail->quantity ;
    }

    public function delete($id) {
        //find object
        $cart_detail = Cart_detail::find($id);
        
        $cart_detail->delete();
        //kiểm tra đơn hàng đã hoàn thành hay chưa

        // Chuyển hướng người dùng về trang danh sách đơn hàng với thông báo thành công
        return redirect()->route('cart.index')->with('success', 'Bạn đã xóa giỏ hàng thành công');

    }

}
