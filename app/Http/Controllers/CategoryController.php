<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\CustomerUser;
use App\Models\Cart;
use App\Models\Cart_detail;

class CategoryController extends Controller
{
    //method index
    public function index() {
        session_start();
        $categories = Category::all();
        $products = Product::with('seller')->paginate(10); 
        $count_cart = 0;
        $productTotal = Product::count();
        $pages = ceil($productTotal)/3;
        if(!empty($_SESSION['user_id'])){
            $id = $_SESSION['user_id'];
            $user = CustomerUser::find($id)->first();
            session(['customerUserId' => $id]);
            $cart = Cart::where('user_id', $id)->first();
            $count_cart = Cart_detail::where('cart_id', $cart->id)->count();
            // dd($_SESSION['user_id']);
            // if(isset($_SESSION["user_id"])){
            //     unset($_SESSION['user_id']);
            //     unset($_SESSION['user_img']);
            //     unset($_SESSION['user_name']);
            //     unset($_SESSION['user_email']);
            // }
        }
        return view('auth.home', 
        [
            'categories' => $categories,
            'products' => $products,
            'pages' => $pages,
            'number' => $count_cart,
        ]); 
    }

    public function show($id) {
        session_start();
        $productTotal = Product::count();
        $pages = ceil($productTotal)/3;
        $products = Product::with('category', 'seller')->where('category_id', $id)->get();
        $categories = Category::all();
        $count_cart = 0;
        $productTotal = Product::count();
        $pages = ceil($productTotal)/3;
        if(!empty($_SESSION['user_id'])){
            $id = $_SESSION['user_id'];
            $user = CustomerUser::find($id)->first();
            session(['customerUserId' => $id]);
            $cart = Cart::where('user_id', $id)->first();
            $count_cart = Cart_detail::where('cart_id', $cart->id)->count();
        }  
        return view('auth.home', 
        [
                'categories' => $categories,
                'products' => $products,
                'pages' => $pages,
                'number' => $count_cart,
        ]);
    }
}
