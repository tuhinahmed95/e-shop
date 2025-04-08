<?php

namespace App\Http\Controllers;

use App\Models\Offer1;
use App\Models\Offer2;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function offer_list(){
        $offers1 = Offer1::all();
        $offers2 = Offer2::all();
        return view('admin.offer.offer_list',compact('offers1','offers2'));
    }

    public function offer1_edit(){
        $offer1 = Offer1::all();
        return view('admin.offer.offer1_update',compact('offer1'));
    }

    public function offer1_update(Request $request, $id){
        // $request->validate([
        //     'title' => 'required',
        //     'price' => 'required',
        //     'discount_price' => 'required',
        //     'date' => 'required',
        // ]);

        if(!$request->hasFile('image')){
            Offer1::find($id)->update([
                'title' => $request->title,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'date' => $request->date,
            ]);
            return back();
        }
        else{

            $offer = Offer1::find($id);
            $old_image_path = public_path('uploads/offer/'.$offer->image);
            unlink($old_image_path);

            $image = $request->file('image');
            $file_name = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/offer'),$file_name);

            Offer1::find($id)->update([
                'title' => $request->title,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'date' => $request->date,
                'image' => $file_name,
            ]);
            return back();
         }
    }

    public function offer2_edit($id){
        $offer2 = Offer2::find($id);
        return view('admin.offer.offer2_update',compact('offer2'));
    }

    public function offer2_update(Request $request,$id){

       $offer2 =  Offer2::find($id);
       if(!$request->hasFile('image')){
            $offer2->update([
                'title' => $request->title,
                'subtitle' => $request->subtitle,
            ]);
            return back();
       }
       else
       {
            $old_path = public_path('uploads/offer/'.$offer2->image);
            if(file_exists($old_path)){
                unlink($old_path);
            }
            $image = $request->file('image');
            $file_name = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/offer'),$file_name);

            $offer2->update([
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'image' => $file_name,

            ]);
            return back();
       }

    }
}
