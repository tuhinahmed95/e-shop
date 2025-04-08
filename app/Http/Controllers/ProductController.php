<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductGallery;

class ProductController extends Controller
{
    public function product_list(){
        $products = Product::all();
        return view('admin.product.product_list',compact('products'));
    }

    public function product_create(){
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        return view('admin.product.product_create',compact('categories','subcategories','brands'));
    }

    public function getSubcategory(Request $request){
       $str = '<option value="">Select Category</option>';
       $subcategories = Subcategory::where('category_id',$request->category_id)->get();
       foreach($subcategories as $subcategory){
        $str.= '<option value="'.$subcategory->id.'">'.$subcategory->subcategory_name.'</option>';
       }
       echo $str;
    }

    public function product_view($id){
        $product = Product::with('category','subcategory','brand','gallery')->findOrFail($id);
        return view('admin.product.single_product_view',compact('product'));
    }

    public function product_store(Request $request){

        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'brand_id' => 'nullable',
            'product_name' => 'required',
            'price' => 'required',
            'discount' => 'nullable',
            'tags' => 'nullable',
            'short_des' => 'nullable',
            'long_des' => 'nullable',
            'addi_info' => 'nullable',
            'preview' => 'required',
            'status' => 'nullable',
            'slug' => 'nullable',
        ]);

        $slug = Str::slug($request->product_name).'-'.rand(1000,2000);
        if($request->hasFile('preview')){
            $preview = $request->file('preview');
            $file_name = time().'.'.$preview->getClientOriginalExtension();
            $preview->move(public_path('uploads/product/preview'),$file_name);
        }
       $product = Product::create([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'brand_id' => $request->brand_id,
            'product_name' => $request->product_name,
            'price' => $request->price,
            'discount' => $request->discount,
            'tags' => implode(',', $request->tags),
            'after_discount' => $request->price -  $request->price*$request->discount/100,
            'short_des' => $request->short_des,
            'long_des' => $request->long_des,
            'addi_info' => $request->addi_info,
            'preview' => $file_name,
            'slug' => $slug,
            'created_at' => Carbon::now(),
        ]);

        $product_id = $product->id;
        $galleries = $request->gallery;
        foreach($galleries as $gallery){
            $file_name = uniqid().'.'.$gallery->getClientOriginalExtension();
            $gallery->move(public_path('uploads/product/gallery'),$file_name);

            ProductGallery::create([
                'product_id' =>$product_id,
                'gallery' => $file_name,
                'created_at' => Carbon::now(),
            ]);
        }


        return redirect()->route('product.list')->with('success', 'Product Successfully Added');
    }

    public function getStatus(Request $request){
        Product::find($request->product_id)->update([
            'status'=>$request->status,
        ]);
    }

    public function product_edit($id){
        $product = Product::with('category','subcategory','brand','gallery')->findOrFail($id);
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        return view('admin.product.product_edit',compact('product','categories','subcategories','brands'));
    }

    public function product_update(Request $request,$id){
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'brand_id' => 'nullable',
            'product_name' => 'required',
            'price' => 'required',
            'discount' => 'nullable',
            'tags' => 'nullable',
            'short_des' => 'nullable',
            'long_des' => 'nullable',
            'addi_info' => 'nullable',
            'preview' => 'nullable',
            'status' => 'nullable',
            'slug' => 'nullable',
        ]);

        $product = Product::find($id);
        $file_name = $product->preview;
        $slug = Str::slug($request->product_name).'-'.rand(1000,2000);
        if($request->hasFile('preview')){
            if($product->preview && file_exists(public_path('uploads/product/preview/').$product->preview)){
                unlink(public_path('uploads/product/preview/').$product->preview);
            }

            $preview = $request->file('preview');
            $file_name = time().'.'.$preview->getClientOriginalExtension();
            $preview->move(public_path('uploads/product/preview'),$file_name);
        }

        $product->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'brand_id' => $request->brand_id,
            'product_name' => $request->product_name,
            'price' => $request->price,
            'discount' => $request->discount,
            'tags' => implode(',', $request->tags),
            'after_discount' => $request->price -  $request->price*$request->discount/100,
            'short_des' => $request->short_des,
            'long_des' => $request->long_des,
            'addi_info' => $request->addi_info,
            'preview' => $file_name,
            'slug' => $slug,
            'updated_at' => Carbon::now(),
        ]);

        if($request->hasFile('gallery')){
            $old_gallery = ProductGallery::where('product_id',$id)->get();
            foreach($old_gallery as $gallery){
                if(file_exists(public_path('uploads/product/gallery/').$gallery->gallery)){
                    unlink(public_path('uploads/product/gallery/').$gallery->gallery);
                }
                $gallery->delete();
            }

            foreach($request->gallery as $gallery){
                $file_name = uniqid().'.'.$gallery->getClientOriginalExtension();
                $gallery->move(public_path('uploads/product/gallery'),$file_name);

                ProductGallery::create([
                    'product_id' => $id,
                    'gallery' => $file_name,
                    'created_at' => Carbon::now(),
                ]);
            }
        }
        return redirect()->route('product.list')->with('update', 'Product Updated Successfully!');

    }

    public function product_delete($id){
        $products = Product::find($id);
        if($products->preview && file_exists(public_path('uploads/product/preview/').$products->preview)){
            unlink(public_path('uploads/product/preview/').$products->preview);
        }

      $galleries = ProductGallery::where('product_id',$id)->get();
      foreach($galleries as $gallery){
        if(file_exists(public_path('uploads/product/gallery/').$gallery->gallery)){
            unlink(public_path('uploads/product/gallery/').$gallery->gallery);
        }
      }

      ProductGallery::where('product_id',$id)->delete();
      $products->delete();
      return redirect()->route('product.list')->with('delete', 'Product Deleted Successfully');
    }


}
