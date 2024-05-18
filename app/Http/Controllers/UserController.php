<?php

namespace App\Http\Controllers;


use Hash;
use Session;
// use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Pagination;
use PragmaRX\Google2FA\Google2FA;

// use App\Models\User;
use App\Models\CustomerUser;
use App\Models\Category;    
use App\Models\Cart;    
/**
 * CRUD User controller
 */
class UserController extends Controller
{

    /**
     * Login page
     */


    public function authUser(Request $request) {
        session_start();

        //kiểm tra email, password không được bỏ trống
        $request->validate(['email'=>'required',
        'password'=>'required']);

        //only : chỉ lấy giá trị được chỉ định
        $credentials = $request->only('email', 'password');
        $user = CustomerUser::where('email',$request->email)->first();  
        //kiểm tra có sai mật khẩu hay email không
        
        //kiểm tra đúng mã otp không
        if($request->get__number_verify === $request->number_verify) {

            if(Auth::guard('tbl_customer_users')->attempt($credentials)){
                session(['email' => $user->email]);
                session(['name' => $user->name]);
                session(['img' => $user->img]);
                // dd(session('email'));
                $_SESSION['user_id'] = $user->id;
                $_SESSION['name'] = $user->name;
                $_SESSION['img'] = $user->img;
                // Gửi cookie về trình duyệt
                return redirect("home");
            }
            else {
                return redirect("home")
                ->with('login', true)
                ->with('pass_wrong', true);
            }
        }else {
            return redirect("home")
            ->with('login', true)
            ->with('otp_wrong', true);
        }
        
        
    }
    

    /**
     * Registration page
     */
    public function createUser()
    {
        return view('register');
    }

    /**
     * User submit form register
     */
    public function postUser(Request $request)
    {
        $data = $request->all(); 

        $check = CustomerUser::where('email', $data['email'])->first();
        if($check != null) {
            return redirect("home")
            ->with('register', true)
            ->with('exit_email', true);
        }else if( strlen($data['password']) < 6 ){
            return redirect("home")
            ->with('register', true)
            ->with('invalid_pass', true);
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = CustomerUser::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        if($user) {
            $cart = Cart::create([
                'user_id' => $user->id,
            ]);
        }

        return redirect("home")
        ->with('login', true)
        ->with('success', true);
    }

    /**
     * View user detail page
     */
    public function readUser(Request $request) {
        $user_id = $request->get('id');
        $user = CustomerUser::find($user_id);

        return view('auth.read', ['user' => $user]);
    }

    /**
     * Delete user by id
     */
    public function deleteUser(Request $request) {
        $user_id = $request->get('id');
        $user = CustomerUser::destroy($user_id);

        return redirect("list")->withSuccess('You have signed-in');
    }

    /**
     * Form update user page
     */
    public function updateUser(Request $request)
    {
        $user_id = $request->get('id');
        $user = CustomerUser::find($user_id);

        return view('auth.update', ['user' => $user]);
    }

    /**
     * Submit form update user
     */
    public function postUpdateUser(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,id,'.$input['id'],
            'password' => 'required|min:6',
        ]);

       $user = CustomerUser::find($input['id']);
       $user->name = $input['name'];
       $user->email = $input['email'];
       $user->password = $input['password'];
       $user->phone = $input['phone'];
       $user->img = $input['img'];
       $user->save();

        return redirect("list")->withSuccess('You have signed-in');
    }

    /**
     * List of users
     */
    public function listUser()
    {
        //kiem tra co dang nhap hay chua
        if(Auth::check()){
            //  $userTotal = User::all();
            $userTotal = CustomerUser::count();
            $users = DB::table('users')->paginate(3);
            $pages = ceil($userTotal/3);
            return view('auth.list', ['users' => $users,"pages" => $pages]);

            //users la so thanh phan trong 1 trang -> no se tu dinh nghia duoc trang nao minh dang chon 
            //su dung $users->previousPageUrl() de quay lai
            // su dung $users->nextPageUrl() de sang trang tiep theo 
            //range de lam tron , vi du tong co 8 thanh phan va duoc chia thanh 3 trang , 8/3 con 2.3 no se lam tron thanh 3 va trang thu 3 se co it thanh phan hon
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    /**
     * Sign out
     */
    public function signOut() {
        Session::flush();
        Auth::logout();
        // Starting session
        session_start();

        // Removing session data
        if(isset($_SESSION["user_id"])){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_img']);
            unset($_SESSION['user_name']);
            unset($_SESSION['user_email']);
        }
        return redirect()->intended('home');
}
}