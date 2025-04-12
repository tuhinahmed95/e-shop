<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\City;
use App\Models\Order;
use App\Models\Billing;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Shipping;
use App\Models\Inventory;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function checkout(){
        $carts = Cart::where('customer_id',Auth::guard('customer')->id())->get();
        $countries = Country::all();
        return view('frontend.checkout_page',compact('carts','countries'));
    }

    public function getCity(Request $request){
        $str = '';
        $cities = City::where('country_id',$request->country_id)->get();
        foreach($cities as $city){
            $str .= '<option value="'.$city->id.'">'.$city->name.'</option>';
        }
        echo $str;
    }

    public function order_store(Request $request){
        if($request->payment_method ==1){
            $order_id = '#'.uniqid().'D-'. Carbon::now()->format('m-d-y');

            Order::create([
                'order_id' => $order_id,
                'customer_id' => Auth::guard('customer')->id(),
                'total' => $request->total + $request->charge,
                'sub_total' => $request->total - $request->discount,
                'charge' => $request->charge,
                'discount' => $request->discount,
                'payment_method' => $request->payment_method,
                'order_date' => Carbon::now()->format('d-m-y'),
                'created_at' => Carbon::now(),
            ]);

            Billing::create([
                'order_id' => $order_id,
                'customer_id' => Auth::guard('customer')->id(),
                'fname' => $request->fname,
                'lname' => $request->lname,
                'country_id' => $request->country,
                'city_id' => $request->city,
                'zip' => $request->zip,
                'company' => $request->company,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'notes' => $request->notes,
                'created_at' => Carbon::now(),
            ]);

            if($request->ship_check == 1){
                $request->validate([
                    'ship_fname' => 'required',
                    'ship_zip' => 'required',
                    'ship_country' => 'required',
                    'ship_city' => 'required',
                ]);

                Shipping::create([
                    'order_id' => $order_id,
                    'ship_fname' => $request->ship_fname,
                    'ship_lname' => $request->ship_lname,
                    'ship_country_id' => $request->ship_country,
                    'ship_city_id' => $request->ship_city,
                    'ship_zip' => $request->ship_zip,
                    'ship_company' => $request->ship_company,
                    'ship_email' => $request->ship_email,
                    'ship_phone' => $request->ship_phone,
                    'ship_address' => $request->ship_address,
                    'created_at' => Carbon::now(),
                ]);
            }else{
                Shipping::create([
                    'order_id' => $order_id,
                    'ship_fname' => $request->fname,
                    'ship_lname' => $request->lname,
                    'ship_country_id' => $request->country,
                    'ship_city_id' => $request->city,
                    'ship_zip' => $request->zip,
                    'ship_company' => $request->company,
                    'ship_email' => $request->email,
                    'ship_phone' => $request->phone,
                    'ship_address' => $request->address,
                    'created_at' => Carbon::now(),
                ]);
            }

            $carts = Cart::where('customer_id',Auth::guard('customer')->id())->get();
            foreach($carts as $cart){
                OrderProduct::create([
                    'order_id' => $order_id,
                    'customer_id' => Auth::guard('customer')->id(),
                    'product_id' => $cart->product_id,
                    'price' => $cart->rel_to_product->after_discount,
                    'color_id' => $cart->color_id,
                    'size_id' => $cart->size_id,
                    'quantity' => $cart->quantity,
                    'created_at' => Carbon::now(),
                ]);
                $cart->delete();
                Inventory::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->decrement('quantity',$cart->quantity);
            }

            Mail::to($request->email)->send(new InvoiceMail($order_id));
            return redirect()->route('order.success')->with('success',$order_id);
        }
        elseif($request->payment_method ==2){
            echo 'ssl';
        }
        elseif($request->payment_method == 3){
            echo 'stripe';
        }
    }

    public function order_success(){
       if(session('success')){
            return view('frontend.order_success');
       }else{
            abort('404');
       }
    }
}
