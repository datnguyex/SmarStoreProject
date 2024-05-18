<?php

namespace App\Http\Controllers;

use Hash;
use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\CustomerUser;
use App\Models\Product;
use App\Models\Category;
use App\Models\Seller;
use App\Models\Comment;
use App\Models\Cart;
use App\Models\Cart_detail;
session_start();
// ly do luc dau ham delete sai vi khong the truyen qua seller id , ham update co id cua seller product da co seller id 
// san roi , ham read duoc truyen truc tiep seller id qua dia chi , con delete chi truyen duoc id cua product thoi 
// -> lam bang form hay dia chi nhu nhau , khac cho delete xoa bang form -> co the truyen it san pham va idseller
// -> return view su dung dia chi cua phuong thuc hien co , co the la post hoac get -> no khong quan trong
// man hinh hien thi view cua 1 blade.php ma minh chon va minh se gan thuoc tinh cho no , khi nhan vo 1 chuc nang 
// vi du nhu sap xep no se truyen qua controller ma con troller do tra ve 1 view khac... ma controller do 
// co 1 route khac nua nen thanh dia chi se thay doi theo luon 
// -> return direct tra ve 1 route trong web, route do co controller thuc hien 1 view gi do...
// va no se tra ra man hinh nhu vay , tuy nhien vi du bai cua thay tra ve list vi controller list 
// da truyen day du thuoc tinh nen man hinh se hien thi ket qua minh mong muon 
// con do an truyen qua form , phai nhan form moi co id ma khi tra ve redirect thi lai khong nhan vao 
// form nen khong co id nen tra ve ket qua khong mong muon



class CrudCustomerUsersController extends Controller
{
    public function viewUserProfile(Request $request)
    {
        $customerUserId = $_SESSION['user_id'];
        $customerUser = CustomerUser::find($customerUserId);
        $dob = $customerUser->DOB;
        $parts = explode('-', $dob);
        $year = $parts[0];
        $month = $parts[1];
        $day = $parts[2];
        $id = $_SESSION['user_id'];
        $user = CustomerUser::find($id)->first();
        $cart = Cart::where('user_id', $user->id)->first();
        $count_cart = Cart_detail::where('cart_id', $cart->id)->count();

        return view('auth.account.profile', [
            'customerUser' => $customerUser,
            'year' => $year,
            'month' => $month,
            'day' => $day,
            'number' => $count_cart
        ]);
    }
    
    public function updateUserProfile(Request $request)  {   
        $input = $request->all();
        $dob = $request->get('year') . "-" . $request->get('month') . "-" . $request->get('day');
        $customerUser = CustomerUser::find($_SESSION['user_id']);
        $customerUser->name = $input['name'];
        $customerUser->username = $input['username'];
        $customerUser->email = $input['email'];
        $customerUser->phone = $input['phone'];
        $customerUser->address = $input['address'];
        $customerUser->sex =  $input['sex'];
        $customerUser->DOB =  $dob;

        if ($request->hasFile('img')) {
            // Xóa hình ảnh cũ (nếu có)
            Storage::delete('img/img_auth/' . $customerUser->img);
    
            // Lưu hình ảnh mới vào thư mục lưu trữ
            $image = $request->file('img');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('img/img_auth'), $imageName);
    
            // Cập nhật tên hình ảnh mới cho sản phẩm
            $customerUser->img = $imageName;
            
        }
        $_SESSION['img'] = $customerUser->img;
        $_SESSION['name'] = $customerUser->name;
        $customerUser->save();
       return redirect("home");
        
    }
   
   
    public function viewSeller(Request $request)
    {   
        if(!empty($_SESSION['user_id'])){
            $idSeller = $_SESSION['user_id'];
            $seller = Seller::find($idSeller); 
            
            if($seller != null){

                if ($request->has('oldest')) {
                    $products = Product::with('Category')->where('seller_id', $idSeller)->orderBy('id')->get();
                    $sellerTotal = Product::with('Category')->where('seller_id',$idSeller)->count();  
                    return view('auth.seller', ['products' => $products,'idSeller' => $idSeller, 'sellerTotal' => $sellerTotal]);
                } else if ($request->has('newest')) {
                    $products = Product::with('Category')->where('seller_id', $idSeller)->orderByDesc('id')->get();
                    $sellerTotal = Product::with('Category')->where('seller_id',$idSeller)->count();  
                    return view('auth.seller', ['products' => $products,'idSeller' => $idSeller, 'sellerTotal' => $sellerTotal]);
                }
            
                else if($request->has('bestselling')) {
                    $products = Product::with('Category')->where('seller_id', $idSeller)->orderBy('sold')->get();  
                    $sellerTotal = Product::with('Category')->where('seller_id',$idSeller)->count();  
                    return view('auth.seller', ['products' => $products,'idSeller' => $idSeller, 'sellerTotal' => $sellerTotal]);
                }

                else if($request->has('priceDESC')) {
                    $products = Product::with('Category')->where('seller_id', $idSeller)->orderBy('price')->get();
                    $sellerTotal = Product::with('Category')->where('seller_id',$idSeller)->count();  
                    return view('auth.seller', ['products' => $products,'idSeller' => $idSeller, 'sellerTotal' => $sellerTotal]);
                }

                else if($request->has('priceASC')) {
                    $products = Product::with('Category')->where('seller_id', $idSeller)->orderByDESC('price')->get();
                    $sellerTotal = Product::with('Category')->where('seller_id',$idSeller)->count();  
                    return view('auth.seller', ['products' => $products,'idSeller' => $idSeller, 'sellerTotal' => $sellerTotal]);
                }

                else {
                    $products = Product::with('Category')->where('seller_id',$idSeller)->get(); 
                    $sellerTotal = Product::with('Category')->where('seller_id',$idSeller)->count();  
                    return view('auth.seller', ['products' => $products,'idSeller' => $idSeller, 'sellerTotal' => $sellerTotal]);
                    // return redirect('seller');
                }
            }
            else {
                return redirect("home")->with('create_store', true);
            }
        }
        else{
            return redirect("home")->with('create_store', true);
        }  
        
    }

    public function viewAddProduct(Request $request)
    {   
       
            $categories = Category::all();
            return view('auth.product',['categories' => $categories, 'seller_id' => $request->get('id')]);
        
        return view('auth.product');
      
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'des' => 'required',
            'category_id' => 'required',
            'seller_id' => 'required',
            'img' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
  
        if ($request->hasFile('img')) {
            // Lưu hình ảnh vào thư mục lưu trữ

            //luu hinh anh vao $image
            $image = $request->file('img');

            //dat ten cho hinh anh neu chon 2 hinh giong nhau
            $imageName = time().'.'.$image->getClientOriginalExtension();

            //luu hinh anh vao 
            $image->move(public_path('img/img_auth'), $imageName);
    
            // Thêm tên hình ảnh vào dữ liệu để lưu vào cơ sở dữ liệu
            $data['img'] = $imageName;
        }
    
   

        $check = Product::create([
            'product_name' => $data['name'],
            'description' => $data['des'],
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'img' => $data['img'],
            'category_id' => $data['category_id'],
            'seller_id' => $data['seller_id']
            
        ]);
        $products = Product::with('Category')->where('seller_id', $request->get('seller_id'))->orderByDESC('id')->get();
        
        $sellerTotal = Product::with('Category')->where('seller_id',$request->get('seller_id'))->count();  
        return view('auth.seller', ['products' => $products,'idSeller' =>  $request->get('seller_id'), 'sellerTotal' => $sellerTotal]);

      
 
    }

    public function viewDetailProduct(Request $request)
    {   
            $productId = $request->get('id');
            $product = Product::with('Category')->find($productId);  
            return view('auth.product_detail',['product' => $product]);
    }

    public function viewDetailProductIndexCusTomerUser(Request $request)
    {   
            $productId = $request->get('productId');
            $customerUserId = session()->get('customerUserId');
            $product = Product::with('Category')->find($productId);  
            $seller = Seller::find($product->seller_id);

            $userComments = Comment::with('CustomerUser')->where('productId',$productId)->orderBy('created_at', 'desc')->get();

            $customerUser = CustomerUser::find($customerUserId);
            $totalComments = Comment::where('productId',$productId)->count();
            $oneStar = Comment::where('productId',$productId)->where('star',1)->count();
            $twoStar = Comment::where('productId',$productId)->where('star',2)->count();
            $threeStar = Comment::where('productId',$productId)->where('star',3)->count();
            $fourStar = Comment::where('productId',$productId)->where('star',4)->count();
            $fiveStar = Comment::where('productId',$productId)->where('star',5)->count();

          
            $totalStar = Comment::where('productId',$productId)->sum('star');
            $evarageStars = ($totalComments > 0) ? round( $totalStar / $totalComments,1)  : 0;
            
            if(is_float($evarageStars) == $evarageStars) {
                $evarageStars = (int)$evarageStars;
            }

            $percenOneStar = ($totalComments > 0) ? ceil(($oneStar / $totalComments) * 100) : 0;
            $percenTwoStar = ($totalComments > 0) ? ceil(($twoStar / $totalComments) * 100) : 0;
            $percenThreeStar = ($totalComments > 0) ? ceil(($threeStar / $totalComments) * 100) : 0;
            $percenFourStar = ($totalComments > 0) ? ceil(($fourStar / $totalComments) * 100) : 0;
            $percenFiveStar = ($totalComments > 0) ? ceil(($fiveStar / $totalComments) * 100) : 0;

            if(!empty($_SESSION['user_id'])){
                $id = $_SESSION['user_id'];
                $user = CustomerUser::find($id)->first();
                session(['customerUserId' => $id]);
                $productTotal = Product::count();
                $pages = ceil($productTotal)/3;
                $cart = Cart::where('user_id', $id)->first();
                $count_cart = Cart_detail::where('cart_id', $cart->id)->count();
                return view('auth.product_detail_customerUser', ['number' => $count_cart  ,'product' => $product, 'seller' => $seller, 'customerUser' => $customerUser, 'userComments' => $userComments, 'totalComments' => $totalComments,'percenOneStar' => $percenOneStar,'percenTwoStar' => $percenTwoStar,'percenThreeStar' => $percenThreeStar,'percenFourStar' => $percenFourStar, 'percenFiveStar' => $percenFiveStar, 'evarageStars' => $evarageStars,'customerUserId' => $customerUserId]);
            }
        
   
        return view('auth.product_detail_customerUser', ['product' => $product, 'seller' => $seller, 'customerUser' => $customerUser, 'userComments' => $userComments, 'totalComments' => $totalComments,'percenOneStar' => $percenOneStar,'percenTwoStar' => $percenTwoStar,'percenThreeStar' => $percenThreeStar,'percenFourStar' => $percenFourStar, 'percenFiveStar' => $percenFiveStar, 'evarageStars' => $evarageStars,'customerUserId' => $customerUserId]);
    }

    public function formComment(Request $request)
    {    
        $request->validate([
            'description' => 'required',
            'img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'productId' => 'required',
            'customerUserId' => 'required',
            'star' => 'required',
        ]);
        if ($request->isMethod('post')) {

        }
        $data = $request->all();
        if ($request->hasFile('img')) {
            // Lưu hình ảnh vào thư mục lưu trữ

            //luu hinh anh vao $image
            $image = $request->file('img');

            //dat ten cho hinh anh neu chon 2 hinh giong nhau
            $imageName = time().'.'.$image->getClientOriginalExtension();

            //luu hinh anh vao 
            $image->move(public_path('img/img_auth'), $imageName);
    
            // Thêm tên hình ảnh vào dữ liệu để lưu vào cơ sở dữ liệu
            $data['img'] = $imageName;
        }
        $check = Comment::create([
            'description' => $data['description'],
            'img' => $data['img'],
            'productId' => $data['productId'],
            'customerUserId' => $data['customerUserId'],
            'star' => $data['star'],
        ]);
            $customerUserId = session()->get('customerUserId');
            $productId = $request->get('productId');
            $customerUserId = $request->get('customerUserId');  
            $product = Product::with('Category')->find($productId);  
            $seller = Seller::find($product->seller_id);
            $userComments = Comment::with('CustomerUser')->where('productId',$productId)->orderBy('created_at', 'desc')->get();
            $customerUser = CustomerUser::find($customerUserId);
            $totalComments = Comment::where('productId',$productId)->count();
            $oneStar = Comment::where('productId',$productId)->where('star',1)->count();
            $twoStar = Comment::where('productId',$productId)->where('star',2)->count();
            $threeStar = Comment::where('productId',$productId)->where('star',3)->count();
            $fourStar = Comment::where('productId',$productId)->where('star',4)->count();
            $fiveStar = Comment::where('productId',$productId)->where('star',5)->count();
            $totalStar = Comment::where('productId',$productId)->sum('star');

            $evarageStars = $totalStar / $totalComments;
            
        
            $floorEvarageStars = is_float($evarageStars) ? floor($evarageStars) : 0;

            $percenOneStar = ($totalComments > 0) ? ceil(($oneStar / $totalComments) * 100) : 0;
            $percenTwoStar = ($totalComments > 0) ? ceil(($twoStar / $totalComments) * 100) : 0;
            $percenThreeStar = ($totalComments > 0) ? ceil(($threeStar / $totalComments) * 100) : 0;
            $percenFourStar = ($totalComments > 0) ? ceil(($fourStar / $totalComments) * 100) : 0;
            $percenFiveStar = ($totalComments > 0) ? ceil(($fiveStar / $totalComments) * 100) : 0;
            
            $categories = Category::all();
            $products = Product::with('seller')->paginate(10);
            if(!empty($_SESSION['user_id'])){
                $id = $_SESSION['user_id'];
                $user = CustomerUser::find($id)->first();
                session(['customerUserId' => $id]);
                $productTotal = Product::count();
                $pages = ceil($productTotal)/3;
                $cart = Cart::where('user_id', $id)->first();
                $count_cart = Cart_detail::where('cart_id', $cart->id)->count();

                return view('auth.product_detail_customerUser', [
                    'number' => $count_cart,
                    'product' => $product, 
                    'seller' => $seller, 
                    'customerUser' => $customerUser, 
                    'userComments' => $userComments, 
                    'totalComments' => $totalComments,
                    'percenOneStar' => $percenOneStar,
                    'percenTwoStar' => $percenTwoStar,
                    'percenThreeStar' => $percenThreeStar,
                    'percenFourStar' => $percenFourStar, 
                    'percenFiveStar' => $percenFiveStar, 
                    'evarageStars' =>  $evarageStars,
                    'customerUserId' => $customerUserId,
                ]);
            }
        
            return view('auth.product_detail_customerUser', [
                'product' => $product, 
                'seller' => $seller, 
                'customerUser' => $customerUser, 
                'userComments' => $userComments, 
                'totalComments' => $totalComments,
                'percenOneStar' => $percenOneStar,
                'percenTwoStar' => $percenTwoStar,
                'percenThreeStar' => $percenThreeStar,
                'percenFourStar' => $percenFourStar, 
                'percenFiveStar' => $percenFiveStar, 
                'evarageStars' =>  $evarageStars,
                'customerUserId' => $customerUserId,
            ]);
        }
    public function arrangeIndexUserCustomer(Request $request)
    {   
        $customerUserId = $request->get('customerUserId');
        $customerUser = CustomerUser::find($customerUserId);    
         if($request->has('newest')) {
            session(['sort_type' => 'newest']);
            $products = Product::with('Category')->orderByDESC('id')->paginate(10);
            $categories = Category::get();
            $productTotal = Product::count();
            $pages = ceil($productTotal)/3;
            return view('auth.home', ['idCustomer' => $customerUser , 'products' => $products,'categories' => $categories, 'pages' => $pages]);
           }
        else if($request->has('oldest')) {
            session(['sort_type' => 'oldest']);
            $products = Product::with('Category')->orderBy('id')->paginate(10);
            $categories = Category::get();
            $productTotal = Product::count();
            $pages = ceil($productTotal)/3;
            return view('auth.home', ['idCustomer' => $customerUser , 'products' => $products,'categories' => $categories, 'pages' => $pages]);
           }
        else if($request->has('bestselling')) {
            session(['sort_type' => 'bestselling']);
            $products = Product::with('Category')->orderBy('sold')->paginate(10);
            $categories = Category::get();
            $productTotal = Product::count();
            $pages = ceil($productTotal)/3;
            return view('auth.home', ['idCustomer' => $customerUser , 'products' => $products,'categories' => $categories, 'pages' => $pages]);
           }
         else if($request->has('priceASC')) {
            session(['sort_type' => 'priceASC']);
            $products = Product::with('Category')->orderByDESC('price')->paginate(10);
            $categories = Category::get();
            $productTotal = Product::count();
            $pages = ceil($productTotal)/3;
            return view('auth.home', ['idCustomer' => $customerUser , 'products' => $products,'categories' => $categories, 'pages' => $pages]);
           }
         else if($request->has('priceDESC')) {
            session(['sort_type' => 'priceDESC']);
            $products = Product::with('Category')->orderBy('price')->paginate(10);
            $categories = Category::get();
            $productTotal = Product::count();
            $pages = ceil($productTotal)/3;
            return view('auth.home', ['idCustomer' => $customerUser , 'products' => $products,'categories' => $categories, 'pages' => $pages]);
           }

    }
    public function returnHome(Request $request)
    {   
        if(session()->has('emailCustomerUser')) {
         $email = session('emailCustomerUser');
        $customerUser = CustomerUser::where('email', $email)->first();  
        $products = Product::with('Category')->orderByDESC('id')->get();
        return view('auth.home', ['idCustomer' => $customerUser , 'products' => $products]);  
        }
        else {
            $email = session('emailSeller');
            $seller = Seller::where('email',$email)->first();
            $idSeller = $seller->id;
            $products = Product::with('Category')->where('seller_id', $idSeller)->orderByDESC('price')->get();
            $sellerTotal = Product::with('Category')->where('seller_id',$idSeller)->count();  
            return view('auth.seller', ['products' => $products,'idSeller' => $idSeller, 'sellerTotal' => $sellerTotal]);
            
        }
    }     
    public function deleteProduct(Request $request)
    {      
            $productId = $request->get('productId');
            $idSeller = $request->get('id_seller');
            $product = Product::destroy($productId);
          
            $products = Product::with('Category')->where('seller_id',$idSeller)->get(); 
         
            $sellerTotal = Product::with('Seller')->where('seller_id',$idSeller)->count();  
            return view('auth.seller', ['products' => $products,'idSeller' => $idSeller, 'sellerTotal' => $sellerTotal]);
         
    }
    public function viewUpdateProduct(Request $request)
    {   
        $productId = $request->get('id');
        $product = Product::find($productId);
        $categories = Category::all();
        return view('auth.update',['product' => $product,'categories' => $categories]);
    }
    public function updateProduct(Request $request)
    {   
        $input = $request->all();
        $idSeller = $request->get('id');
        $product = Product::find($input['id']);
        $product -> product_name = $input['name'];
        $product -> price = $input['price'];
        $product -> description = $input['des'];
        $product -> quantity = $input['quantity'];
        $product -> category_id = $input['category_id'];
        if ($request->hasFile('img')) {
            // Xóa hình ảnh cũ (nếu có)
            Storage::delete('img/img_auth/' . $product->img);
    
            // Lưu hình ảnh mới vào thư mục lưu trữ
            $image = $request->file('img');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('img/img_auth'), $imageName);
    
            // Cập nhật tên hình ảnh mới cho sản phẩm
            $product->img = $imageName;
            
        }
        $product -> save();
        $products = Product::with('Category')->where('seller_id', $request->get('seller_id'))->orderBy('id')->get();
        $sellerTotal = Product::with('Category')->where('seller_id',$request->get('seller_id'))->count();
        return view('auth.seller', ['products' => $products, 'idSeller' => $request->get('seller_id'), 'sellerTotal' => $sellerTotal]);
    } 
    //
    public function viewAdminUserCustomer() {
        $customerUsers = CustomerUser::orderByDESC('id')->get();
        return view('auth.adminUserCustomer',['customerUsers' => $customerUsers]);
    }
    public function viewAdminSeller() {
        $sellers =  Seller::orderByDESC('id')->get();
        return view('auth.adminSeller',['sellers' => $sellers]);
    }
    public function deleteAdminSeller(Request $request) {
       $idSeller = $request->get('id'); 
       $product = Seller::destroy($idSeller);
       return redirect('adminSeller');
    }
    public function deleteAdminCustomerUser(Request $request) {
        $idCustomerUser = $request->get('id'); 
        $product = CustomerUser::destroy($idCustomerUser);
        return redirect('adminUserCustomer');
     }
     public function viewAddAdminCustomerUser(Request $request) {
        return view('auth.addAdminCustomerUser');
     } 
     public function viewAddAdminSeller(Request $request) {
        return view('auth.addAdminSeller');
     } 
     public function viewUpdateAdminSeller(Request $request) {
        $sellerId = $request->get('id');
        $seller = Seller::find($sellerId);
        $dob = $seller->DOB;
        if($dob == null) {
            $dob = "1990-01-01";
        }
        $parts = explode('-', $dob);
        $year = $parts[0];
        $month = $parts[1];
        $day = $parts[2];
        $passwordUnhash = $seller->password;
        return view('auth.updateAdminSeller', [
            'seller' => $seller,
            'passwordUnhash' => $passwordUnhash,
            'year' => $year,
            'month' => $month,
            'day' => $day
        ]);
     } 
     public function viewUpdateAdminCustomerUser(Request $request) {
        $customerUserId = $request->get('id');
        $customerUser = CustomerUser::find($customerUserId);
        $dob = $customerUser->DOB;
        if($dob == null) {
            $dob = "1990-01-01";
        }
        $parts = explode('-', $dob);
        $year = $parts[0];
        $month = $parts[1];
        $day = $parts[2];
        $passwordUnhash = $customerUser->password;
        return view('auth.updateAdminCustomerUser', [
            'customerUser' => $customerUser,
            'passwordUnhash' => $passwordUnhash,
            'year' => $year,
            'month' => $month,
            'day' => $day
        ]);
     } 
     public function formUpdateAdminCustomerUser(Request $request) {
        $input = $request->all();
        $dob = $request->get('year') . "-" . $request->get('month') . "-" . $request->get('day');
        $CustomerUserId = $request->get('id');
        $CustomerUser = CustomerUser::find($CustomerUserId);
        $parts = explode('-', $dob);
        $year = $parts[0];
        $month = $parts[1];
        $day = $parts[2];
        $CustomerUser->name = $input['name'];
        $CustomerUser->username = $input['username'];
        $CustomerUser->email = $input['email'];
        $CustomerUser->phone = $input['phone'];
        $CustomerUser->address = $input['address'];
        $CustomerUser->sex =  $input['sex'];
        $CustomerUser->DOB =  $dob; 

        if ($request->hasFile('img')) {
            // Xóa hình ảnh cũ (nếu có)
            Storage::delete('img/img_auth/' . $CustomerUser->img);
    
            // Lưu hình ảnh mới vào thư mục lưu trữ
            $image = $request->file('img');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('img/img_auth'), $imageName);
    
            // Cập nhật tên hình ảnh mới cho sản phẩm
            $CustomerUser->img = $imageName;   
        }
        $CustomerUser->save();
        // return view('auth.updateAdminCustomerUser', [
        //     'CustomerUser' => $CustomerUser,
        //     'passwordUnhash' => $CustomerUser->password,
        //     'year' => $year,
        //     'month' => $month,
        //     'day' => $day
        // ]);
        return redirect('adminUserCustomer');
     }
     public function formUpdateAdminSeller(Request $request) {
        $input = $request->all();
        $dob = $request->get('year') . "-" . $request->get('month') . "-" . $request->get('day');
        $sellerId = $request->get('id');
        $seller = Seller::find($sellerId);
        $parts = explode('-', $dob);
        $year = $parts[0];
        $month = $parts[1];
        $day = $parts[2];
        $seller->name = $input['name'];
        $seller->username = $input['username'];
        $seller->email = $input['email'];
        $seller->phone = $input['phone'];
        $seller->address = $input['address'];
        $seller->sex =  $input['sex'];
        $seller->DOB =  $dob; 

        if ($request->hasFile('img')) {
            // Xóa hình ảnh cũ (nếu có)
            Storage::delete('img/img_auth/' . $seller->img);
    
            // Lưu hình ảnh mới vào thư mục lưu trữ
            $image = $request->file('img');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('img/img_auth'), $imageName);
    
            // Cập nhật tên hình ảnh mới cho sản phẩm
            $seller->img = $imageName;   
        }
        $seller->save();
        // return view('auth.updateAdminSeller', [
        //     'seller' => $seller,
        //     'passwordUnhash' => $seller->password,
        //     'year' => $year,
        //     'month' => $month,
        //     'day' => $day
        // ]);
        return redirect('adminSeller');
     }
     public function formAddAdminCustomerUser(Request $request) {
        $data = $request->all();
        $dob = $request->get('year') . "-" . $request->get('month') . "-" . $request->get('day');
        if ($request->hasFile('img')) {
            // Lưu hình ảnh vào thư mục lưu trữ

            //luu hinh anh vao $image
            $image = $request->file('img');

            //dat ten cho hinh anh neu chon 2 hinh giong nhau
            $imageName = time().'.'.$image->getClientOriginalExtension();

            //luu hinh anh vao 
            $image->move(public_path('img/img_auth'), $imageName);
    
            // Thêm tên hình ảnh vào dữ liệu để lưu vào cơ sở dữ liệu
            $data['img'] = $imageName;
        }
        $hashedPassword = hash::make($data['password']);
        $check = CustomerUser::create([
            'username' => $data['username'],
            'password' => $hashedPassword,
            'name' => $data['name'],
            'email' => $data['email'],
            'img' => $data['img'],
            'phone' => $data['phone'],
            'sex' => $data['sex'],
            'address' => $data['address'],
            'DOB' => $dob,
        ]);
        return redirect('adminUserCustomer');
     } 
     public function formAddAdminSeller(Request $request) {
        $data = $request->all();
        $dob = $request->get('year') . "-" . $request->get('month') . "-" . $request->get('day');
        if ($request->hasFile('img')) {
            // Lưu hình ảnh vào thư mục lưu trữ

            //luu hinh anh vao $image
            $image = $request->file('img');

            //dat ten cho hinh anh neu chon 2 hinh giong nhau
            $imageName = time().'.'.$image->getClientOriginalExtension();

            //luu hinh anh vao 
            $image->move(public_path('img/img_auth'), $imageName);
    
            // Thêm tên hình ảnh vào dữ liệu để lưu vào cơ sở dữ liệu
            $data['img'] = $imageName;
        }
        $hashedPassword = hash::make($data['password']);
        $check = Seller::create([
            'username' => $data['username'],
            'password' => $hashedPassword,
            'name' => $data['name'],
            'email' => $data['email'],
            'img' => $data['img'],
            'phone' => $data['phone'],
            'sex' => $data['sex'],
            'address' => $data['address'],
            'DOB' => $dob,
        ]);
        return redirect('adminSeller');
     } 
     public function viewAdminProfile(Request $request) {
        $adminId = $request->get('id');
        $admin = Admin::find($adminId);
        $dob = $admin->DOB;
        if($dob == null) {
            $dob = "1990-01-01";
        }
        $parts = explode('-', $dob);
        $year = $parts[0];
        $month = $parts[1];
        $day = $parts[2];
        return view('auth.account.adminProfile', [
            'admin' => $admin,
            'year' => $year,
            'month' => $month,
            'day' => $day
        ]);
     }
     public function updateAdminProfile(Request $request) {
        $input = $request->all();
        $dob = $request->get('year') . "-" . $request->get('month') . "-" . $request->get('day');
        $adminId = $request->get('id');
        $admin = Admin::find($adminId);
        $parts = explode('-', $dob);
        $year = $parts[0];
        $month = $parts[1];
        $day = $parts[2];
        $admin->name = $input['name'];
        $admin->username = $input['username'];
        $admin->email = $input['email'];
        $admin->phone = $input['phone'];
        $admin->address = $input['address'];
        $admin->sex =  $input['sex'];
        $admin->DOB =  $dob;
        session(['emailAdmin' => $admin->email]); 
        if ($request->hasFile('img')) {
            // Xóa hình ảnh cũ (nếu có)
            Storage::delete('img/img_auth/' . $admin->img);
    
            // Lưu hình ảnh mới vào thư mục lưu trữ
            $image = $request->file('img');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('img/img_auth'), $imageName);
    
            // Cập nhật tên hình ảnh mới cho sản phẩm
            $admin->img = $imageName;   
        }
        $admin->save();
        return view('auth.account.adminProfile', [
            'admin' => $admin,
            'year' => $year,
            'month' => $month,
            'day' => $day
        ]);
     }
     public function adminSellerDetail(Request $request) {
        $sellerId = $request->get('id');
        $seller = Seller::find($sellerId);
        $dob = $seller->DOB;
        if($dob == null) {
            $dob = "1990-01-01";
        }
        $parts = explode('-', $dob);
        $year = $parts[0];
        $month = $parts[1];
        $day = $parts[2];
        $products = Product::with('Category')->where('seller_id',$sellerId)->get();
        return view('auth.adminSellerDetail', [
            'seller' => $seller,
            'year' => $year,
            'month' => $month,
            'day' => $day,
            'products' => $products,
        ]);
     }
     public function viewProductPage(Request $request)
     {     
         if (session()->has('sort_type')) {
             $sortType = session('sort_type');
             if ($sortType === 'newest') {
                 $products = Product::with('Category')->orderByDesc('id')->paginate(10);
             } elseif ($sortType === 'oldest') {
                 $products = Product::with('Category')->orderBy('id')->paginate(10);
             } elseif ($sortType === 'bestselling') {
                 $products = Product::with('Category')->orderBy('sold')->paginate(10);
             } elseif ($sortType === 'priceASC') {
                 $products = Product::with('Category')->orderByDESC('price')->paginate(10);
             } elseif ($sortType === 'priceDESC') {
                 $products = Product::with('Category')->orderBy('price')->paginate(10);
             }
             // Tạo các biến $categories, $productTotal, $pages chỉ khi cần thiết
             $categories = Category::get();
             $productTotal = Product::count();
             $pages = ceil($productTotal) / 3;
 
             // Lấy thông tin khách hàng nếu cần
             $email = session('emailCustomerUser');
             $customerUser = CustomerUser::where('email', $email)->first();  
 
             return view('auth.home', ['idCustomer' => $customerUser, 'products' => $products, 'categories' => $categories, 'pages' => $pages]);
         }
         else {
             $products = Product::with('Category')->orderByDesc('id')->paginate(10);
             $categories = Category::get();
             $productTotal = Product::count();
             $pages = ceil($productTotal) / 3;
 
             // Lấy thông tin khách hàng nếu cần
             $email = session('emailCustomerUser');
             $customerUser = CustomerUser::where('email', $email)->first();  
 
             return view('auth.home', ['idCustomer' => $customerUser, 'products' => $products, 'categories' => $categories, 'pages' => $pages]);
         }
 }
        public function viewLoginAdmin(Request $request) {
            return view('auth.loginAdmin');
        }
        public function formLoginAdmin(Request $request) {
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);
        
            $credentials = $request->only('email', 'password');
            if (Auth::guard('table_admin')->attempt($credentials)) { 
                return redirect('adminUserCustomer');
            }
            return redirect('loginAdmin');
        }
}
