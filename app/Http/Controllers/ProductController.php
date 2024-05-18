<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    //method get products by key input
    public function getProductsByKeyword($key)
    {
       $products = Product::where('product_name', 'like', '%' . $request->key . '%')
       ->get();
       return $products;
    }

    public function ajaxSearch()
    {
        $key = request('search');
        // dd($key);
        if (strlen($key) > 0) {
            $products = Product::where('product_name', 'like', '%' . $key . '%')
           ->get();
        //    dd($products);
           return $products;
        }
    }
}
