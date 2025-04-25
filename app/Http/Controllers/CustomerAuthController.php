<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerEmailVerify;
use App\Notifications\EmailVerifyNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class CustomerAuthController extends Controller
{
    public function customer_login(){
        return view('frontend.customer.customer_login');
    }

    public function customer_register(){
        return view('frontend.customer.customer_register');
    }

    public function customer_register_store(Request $request){
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
        ]);

        $customer_info = Customer::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ]);
        Customer::where('customer_id',$customer_info->id)->delete();
        $info = CustomerEmailVerify::create([
            'customer_id' => $customer_info->id,
            'token' => uniqid(),
            'created_at' => Carbon::now(),
        ]);

        Notification::send($customer_info, new EmailVerifyNotification($info));
        return redirect()->route('customer.login');
    }

    public function customer_logged(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if(Customer::where('email',$request->email)->exists()){
            if(Auth::guard('customer')->attempt(['email'=>$request->email,'password'=>$request->password])){
                return redirect()->route('index')->with('login','You Are Logged In');
            }
            else{
                return back()->with('wrong','Does Not Match Credintial');
            }
        }
        else{
            return back()->with('exists','Email Does not Match');
        }
    }

   
}
