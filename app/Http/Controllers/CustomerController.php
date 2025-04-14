<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

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

    public function my_orders(){
        $my_orders = Order::where('customer_id',Auth::guard('customer')->id())->latest()->get();
        return view('frontend.customer.my_orders',compact('my_orders'));
    }

    public function invoice_download($id){
        $order =  Order::find($id);

        $html = View::make('frontend.customer.my_invoice',[
            'order_id'=>$order->order_id,
        ])->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream('invoice_' . $order->id . '.pdf');
    }
}
