<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\CustomerUser;
use App\Models\Seller;
use App\Models\Cart;
use App\Models\Cart_detail;

class FindController extends Controller
{
    //
    public function index(Request $request) {
        session_start();
        $categories = Category::all();
        $products = Product::with('category', 'seller')->where('product_name', 'like', '%' . $request->key . '%')
        ->orWhere('description', 'like', '%' . $request->key . '%')
        ->orWhere('price', 'like', '%' . $request->key . '%')
        ->get();
        $count_cart = 0;
        if(!empty($_SESSION['user_id'])){
            $id = $_SESSION['user_id'];
            $user = CustomerUser::find($id);
            $cart = Cart::where('user_id', $id)->first();
            $count_cart = Cart_detail::where('cart_id', $cart->id)->count();
        }
        return view('auth.find', [
            'categories' => $categories,
            'user' => $user[0],
            'products' => $products,
            'number' => $count_cart,
        ]);
    }

    public function show($id) {
        session_start();
        $products = Product::with('category', 'seller')->where('category_id', $id)->get();
        $categories = Category::all();  
        $count_cart = 0;
        if(!empty($_SESSION['user_id'])){
            $id = $_SESSION['user_id'];
            $user = CustomerUser::find($id);
            $cart = Cart::where('user_id', $id)->first();
            $count_cart = Cart_detail::where('cart_id', $cart->id)->count();
        }
        return view('auth.find', [
            'categories' => $categories,
            'user' => $user,
            'products' => $products,
            'number' => $count_cart,
        ]);
    }

    public function findProductName($name) {
        session_start();
        $categories = Category::all();
        $products = Product::find($name)
        ->first();
        dd($products);
        if(!empty($_SESSION['user_id'])){
            $id = $_SESSION['user_id'];
            $user = CustomerUser::find($id)->first();
            return view('auth.find', [
                'categories' => $categories,
                'user' => $user,
                'products' => $products,
            ]);
        }
        else{
            return view('auth.find', [
                'categories' => $categories,
                'products' => $products,
            ]);
        }  
    }

    
}
