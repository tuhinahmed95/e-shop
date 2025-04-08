<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function profile(){
        return view('frontend.customer.customer_profile');
    }

    public function customer_logout(){
        Auth::guard('customer')->logout();
        return redirect()->route('index')->with('logout','You Are Logged Out');
    }
}
