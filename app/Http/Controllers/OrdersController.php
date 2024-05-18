<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Cart_detail;
use App\Models\Product;

class OrdersController extends Controller
{
    //method index
    public function index() {
        $order = Order::all();
        // dd($order); 
        return view('orders.orders', [
            'order' => $order,
        ]);
    }

    //method delete order(hủy đơn hàng)
    public function delete($id) {
        //find object
        $order = Order::find($id);
        
        //kiểm tra đơn hàng đã hoàn thành hay chưa
        $order['PaymentStatus'] !== 'Completed' ? $order->delete() : null;

        // Chuyển hướng người dùng về trang danh sách đơn hàng với thông báo thành công
        return redirect()->route('orders.index')->with('success', 'Bạn đã xóa đơn hàng thành công');

    }

    //method show detail order
    public function show($id) {
        //select bản orderDetail cùng với bản product
        $orders = OrderDetail::with('Orders', 'product')->where('order_id',$id)->get();
        $order = Order::find($id);
        $status = $order->PaymentStatus;
        // dd($status);
        return view('orders.order_detail', [
            'orders' => $orders,
            'status' => $status,
            'id' => $id,
        ]);
    }

    //method create order
    public function store(Request $request) {
        session_start();
        $user_id = $_SESSION['user_id'];
        // Lấy giá trị của cookie "carts" từ $_COOKIE
        $cookieValue = isset($_COOKIE['carts']) ? $_COOKIE['carts'] : '';
        
        // Sử dụng json_decode để chuyển đổi giá trị từ chuỗi JSON thành một mảng PHP
        $arrayCart = json_decode($cookieValue, true);
        //xử lý kho trong mảng chỉ có 1 phần tử

        $request->validate([
            'customer_id' => 'requited',
            'PaymentMethod' => 'requited',
            'PaymentStatus' => 'requited',
        ]);

        $data = $request->all();

        //add order to table
        $order = Order::create([
            'customer_id' => $user_id,
            'TotalAmount' => $data['TotalAmount'],
            'PaymentMethod' => 'Cash',
            'PaymentStatus' => 'Verify',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $cart = Cart::where('user_id', $user_id)->first();
        foreach($arrayCart as $product_id) {
            $product = Product::where('id', $product_id)->first();
            $cart_detail = Cart_detail::where('cart_id',$cart->id)
            ->first();
            $order_detail =  OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $cart_detail->product_id,
                'quantity' => $cart_detail->quantity,
                'seller_id' => $product->seller_id,
                'price' => $product->price,
                'total' => $cart_detail->quantity * $product->price,
            ]);
            $product -> sold = $product->sold + $cart_detail->quantity;
            $product -> quantity = $product->quantity - $cart_detail->quantity;
            $product->save();
            $cart_detail->delete();
        }
        return redirect("home")->with('success', true);

    }

    //method update order
    public function updateStatus($id) {

        // $idCustomer = $request->get('id');
        $order = Order::find($id);
        $order -> PaymentStatus = 'Failed';
        
        //save order to table
        $order -> save();

        //chuyển hướng nếu cần
        return redirect()->route('orders.index');
    }

    // public function viewUserOrder(Request $request)
    // {
    //     session_start();
    //     $customerUserId = $_SESSION['user_id'];
    //     $Order = Order::where('user_id', $customerUserId);
    //     $order = OrderDetail::where('user_id', $customerUserId)->get();
    //     dd($order); 
    //     return view('auth.account.order', [
    //         'orders' => $order,
    //     ]);
    // }
}