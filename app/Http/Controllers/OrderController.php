<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderCancel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order_list(){
        $orders = Order::all();
        return view('admin.orders.orders_list',compact('orders'));
    }

    public function order_status_update(Request $request,$id){
        Order::find($id)->update([
            'status' => $request->status,
        ]);
        return back();
    }

    public function order_cancel($id){
        $orders = Order::find($id);
        return view('frontend.customer.order_cancel',compact('orders'));
    }

    public function order_cancel_request(Request $request,$id){
        $request->validate([
            'reason' => 'required',
        ]);

        if($request->image == ''){
            OrderCancel::create([
                'order_id' => $id,
                'reason' => $request->reason,
                'created_at' => Carbon::now(),
            ]);

            return back()->with('req','Order Cancel Successfully');
        }
        else{
            if($request->hasFile('image')){
                $image = $request->file('image');
                $file_name = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('uploads/cancelorder'),$file_name);
            }

            OrderCancel::create([
                'order_id' => $id,
                'reason' => $request->reason,
                'image' => $file_name,
                'created_at' => Carbon::now(),
            ]);
            return back()->with('req','Order Cancel Successfully');
        }
    }

    public function order_cancel_list(){
        $orderCancels = OrderCancel::all();
        return view('admin.orders.order_cancel_list',compact('orderCancels'));
    }
}
