<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    //
    // public function testEmail() {
    //     Mail::to('nguyenminhhiep.tdc2223@gmail.com')->send(new OrderShipped());
    //     return response()->json(['message' => 'Order processed successfully']);
    // }

    public function index() {
        
    }

}
