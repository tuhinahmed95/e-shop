<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function banner_list(){
        $banners = Banner::all();
        return view('admin.banner.banner_list',compact('banners'));
    }

    public function banner_create(){
        $categories = Category::all();
        return view('admin.banner.banner_create' , compact('categories'));
    }

    public function banner_store(Request $request){
        $request->validate([
            'title' => 'nullable',
            'banner_image' => 'required',
        ]);

        if($request->hasFile('banner_image')){
            $banner_image = $request->file('banner_image');
            $file_name = time().'.'.$banner_image->getClientOriginalExtension();
            $banner_image->move(public_path('uploads/banner'),$file_name);
        }
        Banner::create([
            'title' => $request->banner_title,
            'category_id' => $request->category_id,
            'banner_image' => $file_name,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('banner.list')->with('success', 'Banner Successfully Added!');
    }

    public function banner_edit($id){
        $banner = Banner::find($id);
        $categories = Category::all();
        return view('admin.banner.banner_edit',compact('banner','categories'));
    }

    public function banner_update(Request $request,$id){
        $request->validate([
            'banner_title' => 'required',
            'banner_image' => 'required',
        ]);

        $banner = Banner::find($id);
        $file_name = $banner->banner_image;

        if($banner->banner_image && file_exists(public_path('uploads/banner/'.$banner->banner_image))){
            unlink(public_path('uploads/banner/'.$banner->banner_image));
        }
        if($request->hasFile('banner_image')){
            $banner_image = $request->file('banner_image');
            $file_name = time().'.'.$banner_image->getClientOriginalExtension();
            $banner_image->move(public_path('uploads/banner'),$file_name);
        }
        $banner->update([
            'title' => $request->banner_title,
            'banner_image' => $file_name,
            'category_id' => $request->category_id,
        ]);
        return redirect()->route('banner.list')->with('update', 'Banner Updated!');
    }

    public function banner_delete($id){
        $banner = Banner::find($id);

        if ($banner && $banner->banner_image && file_exists(public_path('uploads/banner/' .$banner->banner_image))) {
            unlink(public_path('uploads/banner/' . $banner->banner_image));
        }

        $banner->delete();
        return back();
    }
}
