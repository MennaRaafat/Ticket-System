<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OtpFactoryController extends Controller
{
    public function index(){
        return view ('auth.verifyOtp');
    }

    public function store(Request $request){
        $user = Auth::user();
        if($request -> input('otp') == $user -> otp){
            $user ->resetOTP();
            return redirect() -> route('home');
        }else{
            return redirect() -> back() -> withErrors(['otp' => 'The Verification code you entered is wrong']);
        }
    }
}
