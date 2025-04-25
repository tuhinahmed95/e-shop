<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Passreset;
use App\Notifications\PassResetNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PassResetController extends Controller
{
    public function pass_reset(){
        return view('frontend.customer.reset_pass');
    }

    public function pass_reset_request(Request $request){
        $request->validate([
            'email' => 'required',
        ]);

        if(Customer::where('email',$request->email)->exists()){
            $customer = Customer::where('email',$request->email)->first();
            Passreset::where('customer_id',$customer->id)->delete();
            $info = Passreset::create([
                'customer_id' => $customer->id,
                'token' => uniqid(),
                'created_at' => Carbon::now(),
            ]);
            Notification::send($customer, new PassResetNotification($info));
            return back()->with('send', "We have sent you password reset on your $customer->email");
        }
        else{
            return back()->with('wrong', 'Email Does Not Match');
        }
    }

    public function pass_reset_form($token){
        return view('frontend.customer.pass_reset_form',compact('token'));
    }

    public function pass_reset_confirm(Request $request,$token){
        $passreset = Passreset::where('token',$token)->first();
        if(Passreset::where('token',$token)->exists()){
            Customer::find($passreset->customer_id)->update([
                'password' => Hash::make($request->password),
            ]);
            Passreset::where('token',$token)->delete();
            return redirect()->route('customer.login')->with('reset','Your Password Reset Successfully');
;        }
        else{
            abort('404');
        }
    }
}
