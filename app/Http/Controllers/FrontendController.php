<?php
namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Offer1;
use App\Models\Offer2;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function welcome()
    {
        $categories = Category::all();
        $banners    = Banner::all();
        $offer      = Offer1::all();
        $offer2     = Offer2::all();
        $products   = Product::latest()->take(8)->get();
        return view('frontend.index', compact('categories', 'banners', 'offer', 'offer2', 'products'));
    }

    public function subscriber_store(Request $request)
    {
        Subscriber::create([
            'customer_id' => 1,
            'email'       => $request->email,
        ]);
        return back();
    }

    public function product_details($slug)
    {
        $product_id      = Product::where('slug', $slug)->first()->id;
        $product_info    = Product::find($product_id);
        $galleries       = ProductGallery::where('product_id', $product_id)->get();
        $available_color = Inventory::where('product_id', $product_id)->groupBy('color_id')->selectRaw('sum(color_id) as sum, color_id')->get();
        $available_size  = Inventory::where('product_id', $product_id)->groupBy('size_id')->selectRaw('sum(size_id) as sum, size_id')->get();
        return view('frontend.product_details', compact('product_info', 'galleries', 'available_color', 'available_size'));
    }

    public function getSize(Request $request)
    {
        $str   = '';
        $sizes = Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->get();
        foreach ($sizes as $size) {
            if($size->rel_to_size->size_name == 'N/A'){
                $str = '<li class="color1"><input class="size_id"  checked disabled id="size'.$size->size_id.'" type="radio" name="size_id" value="'.$size->size_id.'">
                <label for="color'. $size->size_id.'">'.$size->rel_to_size->size_name.'</label>
            </li>';
            }
            else{
                $str .= '<li class="color1"><input class="size_id" checked disabled id="size'.   $size->size_id.'" type="radio" name="size_id" value="'.$size->size_id.'">
                    <label for="color'. $size->size_id.'">'.$size->rel_to_size->size_name.'</label>
                </li>';
            }
        }
        echo $str;
    }

    public function getQuantity(Request $request){
        $stock = '';
        $quantity = Inventory::where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->first()->quantity;

        if($quantity == 0){
            $stock = '<li><span id="quan" class="btn btn-danger d-none">Out Of Stock</span></li>';
        }
        else{
            $stock = '<li><span id="quan" class="btn btn-success d-none">'.$quantity.'In Stock'.'</span></li>';
        }

        echo $stock;
    }
}
