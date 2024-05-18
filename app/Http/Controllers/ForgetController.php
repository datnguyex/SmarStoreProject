<?php

namespace App\Http\Controllers;

use Hash;
use Session;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CustomerUser;
use Mail;
use App\Mail\SetPassword;

class ForgetController extends Controller
{
    private $email;
    private $otp;

    public function index() {
        return view('auth.account.forget');
    }
    
    public function randomNumber() {
        $otp = "";
        for($i = 0; $i < 4 ; $i++) {
            $randomNumber = random_int(0, 9);
            $otp .= (string)$randomNumber;
        }
        return $otp;
    }

    public function findUser(Request $request) {
        $input = $request->input(); 
        $this->email = $input['email'] ?? null;
        $otp = $this->randomNumber();
        $user = CustomerUser::where('email', $this->email)->first();
        session([
            "otp" => $otp,
            "email_act" => $this->email
        ]);
        if($user != null) {
            Mail::to($this->email)->send(new SetPassword($otp));
            return view('emails.setPassword');
        }
        return redirect('forget')->with("email không tồn tại");
    }

    public function setPassword(Request $request) {
        $otp = session('otp');
        $email = session('email_act');
        
        if ($request->has('password_new') && $otp === $request['otp']) {
            $user = CustomerUser::where('email', $email)->first();
            if($user != null) {
                $user->password = Hash::make($request['password_new']);
                $user->save();
                return redirect("home")->with('success', true);
            }
        }
        return redirect('forget')->with("sai mã otp");
        // Tiếp tục xử lý phần còn lại của phương thức
    }

    // Các phương thức getter và setter cho email và otp
    private function setEmail($email) {
        $this->email = $email;
    }

    private function getEmail() {
        return $this->email;
    }

    private function setOTP($otp) {
        $this->otp = $otp;
    }

    private function getOTP() {
        return $this->otp;
    }
}
