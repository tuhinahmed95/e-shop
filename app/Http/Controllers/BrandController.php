<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function brand_list(){
        $brands = Brand::all();
        return view('admin.brand.brand_list',compact('brands'));
    }

    public function brand_create(){
        return view('admin.brand.brand_create');
    }

    public function brand_store(Request $request){
        $request->validate([
            'brand_name' => 'required',
        ]);

        $file_name = '';
        if($request->hasFile('brand_icon')){
            $brand_icon = $request->file('brand_icon');
            $file_name = time().'.'. $brand_icon->getClientOriginalExtension();
            $brand_icon->move(public_path('uploads/brand'),$file_name);
        }

        Brand::create([
            'brand_name' => $request->brand_name,
            'brand_logo' => $file_name,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('brand.list')->with('brand', 'Brand Added Successfully');
    }

    public function brand_edit($id){
        $brand = Brand::find($id);
        return view('admin.brand.brand_edit',compact('brand'));
    }

    public function brand_update(Request $request,$id){
        $request->validate([
            'brand_name' => 'required',
        ]);

        $brands = Brand::find($id);
        $file_name = $brands->brand_logo;

        if($request->hasFile('brand_icon')){
            if($brands->brand_logo && file_exists(public_path('uploads/brand/'.$brands->brand_logo))){
                unlink(public_path('uploads/brand/'.$brands->brand_logo));
            }

            $brand_icon = $request->file('brand_icon');
            $file_name = time().'.'. $brand_icon->getClientOriginalExtension();
            $brand_icon->move(public_path('uploads/brand'),$file_name);
        }

        $brands->update([
            'brand_name' => $request->brand_name,
            'brand_logo' => $file_name,
        ]);

        return redirect()->route('brand.list')->with('b_update', 'Brand Updated!');
    }

    public function brand_delete($id){
        $brands = Brand::find($id);
        if($brands->brand_logo && file_exists(public_path('uploads/brand/'.$brands->brand_logo))){
            unlink(public_path('uploads/brand/'.$brands->brand_logo));
        }
        $brands->delete();
        return back()->with('b_delete', 'A Brand Has Been Deleted!');
    }
}
