<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function coupon_list(){
        $coupons = Coupon::all();
        return view('admin.coupon.coupon_list',compact('coupons'));
    }

    public function coupon_create(){
        return view('admin.coupon.coupon_create');
    }

    public function coupon_store(Request $request){
        $request->validate([
            'coupon' => 'required',
            'type' => 'required',
            'amount' => 'required',
            'validity' => 'required',
            'limit' => 'required',
        ]);

        Coupon::create([
            'coupon' => $request->coupon,
            'type' => $request->type,
            'amount' => $request->amount,
            'validity' => $request->validity,
            'limit' => $request->limit,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('coupon.list')->with('success','Coupon Added!');
    }

    public function coupon_status($id){
        $coupon = Coupon::find($id);
        if($coupon->status == 1){
            $coupon->update([
                'status' => 0,
            ]);
            return back();
        }
        else
        {
            $coupon->update([
                'status' => 1,
            ]);
            return back();
        }
    }

    public function coupon_edit($id){
        $coupon = Coupon::find($id);
        return view('admin.coupon.coupon_edit',compact('coupon'));
    }

    public function coupon_update(Request $request,$id){
        Coupon::find($id)->update([
            'coupon' => $request->coupon,
            'type' => $request->type,
            'amount' => $request->amount,
            'validity' => $request->validity,
            'limit' => $request->limit,
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('coupon.list')->with('update','Coupon Updated!');
    }

    public function coupon_delete($id){
        Coupon::find($id)->delete();
        return back()->with('delete','Coupon Dleleted!');
    }
}
