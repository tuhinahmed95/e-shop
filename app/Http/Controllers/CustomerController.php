<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function profile(){
        return view('frontend.customer.customer_profile');
    }

    public function customer_logout(){
        Auth::guard('customer')->logout();
        return redirect()->route('index')->with('logout','You Are Logged Out');
    }

    public function customer_update(Request $request){
        if($request->password == ''){
            if($request->photo == ''){
                Customer::find(Auth::guard('customer')->id())->update([
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'phone' => $request->phone,
                    'zip'   => $request->zip,
                    'address' => $request->address,
                ]);
                return back();
            }
            else{
                $customer = Customer::find(Auth::guard('customer')->id());
                if($customer && $customer->photo && file_exists(public_path('uploads/customer/'.$customer->photo))){
                    unlink(public_path('uploads/customer/'.$customer->photo));
                }
                if($request->hasFile('photo')){
                    $image = $request->file('photo');
                    $file_name = time().'.'.$image->getClientOriginalExtension();
                    $image->move(public_path('uploads/customer'),$file_name);
                }
                Customer::find(Auth::guard('customer')->id())->update([
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'phone' => $request->phone,
                    'zip'   => $request->zip,
                    'photo' => $file_name,
                    'address' => $request->address,
                ]);
                return back();
            }
        }
        else{
            if($request->photo == ''){
                Customer::find(Auth::guard('customer')->id())->update([
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'phone' => $request->phone,
                    'zip'   => $request->zip,
                    'password' => Hash::make($request->password),
                    'address' => $request->address,
                ]);
                return back();
            }
            else{

                $customer = Customer::find(Auth::guard('customer')->id());
                if($customer && $customer->photo && file_exists(public_path('uploads/customer/'.$customer->photo))){
                    unlink(public_path('uploads/customer/'.$customer->photo));
                }
                if($request->hasFile('photo')){
                    $image = $request->file('photo');
                    $file_name = time().'.'.$image->getClientOriginalExtension();
                    $image->move(public_path('uploads/customer'),$file_name);
                }
                Customer::find(Auth::guard('customer')->id())->update([
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'phone' => $request->phone,
                    'zip'   => $request->zip,
                    'photo' => $file_name,
                    'password' => Hash::make($request->password),
                    'address' => $request->address,
                ]);
                return back();
            }
        }
    }
}
