<?php
namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Offer1;
use App\Models\Offer2;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\Subscriber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $reviews         = OrderProduct::where('product_id',$product_id)->whereNotNull('review')->get();
        $total_review    = OrderProduct::where('product_id',$product_id)->whereNotNull('review')->count();
        $total_star      = OrderProduct::where('product_id',$product_id)->whereNotNull('review')->sum('star');

        $available_color = Inventory::where('product_id', $product_id)->groupBy('color_id')->selectRaw('sum(color_id) as sum, color_id')->get();
        $available_size  = Inventory::where('product_id', $product_id)->groupBy('size_id')->selectRaw('sum(size_id) as sum, size_id')->get();
        return view('frontend.product_details', compact('product_info', 'galleries', 'available_color', 'available_size','reviews','total_review','total_star'));
    }

    function getSize(Request $request)
    {
        $str = '';
        $sizes = Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->get();
        foreach ($sizes as $size) {
            if ($size->rel_to_size->size_name == 'NA') {
                $str = '<li class="color"><input checked class="size_id" id="size' . $size->size_id . '" type="radio" name="size_id" value="' . $size->size_id . '"><label for="size' . $size->size_id . '">' . $size->rel_to_size->size_name . '</label>
                </li>';
            } else {
                $str .= '<li class="color"><input class="size_id" id="size' . $size->size_id . '" type="radio" name="size_id" value="' . $size->size_id . '"><label for="size' . $size->size_id . '">' . $size->rel_to_size->size_name . '</label>
                </li>';
            }
        }
        echo $str;
    }

    public function getQuantity(Request $request){
        $str = '';
        $quantity = Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->first()->quantity;
        if ($quantity == 0) {
            $str = '<strong id="quan" class="btn btn-danger" >Out of Stock</strong>';
        } else {
            $str = '<strong id="quan" class="btn btn-success" >' . $quantity . ' In Stock</strong>';;
        }
        echo $str;
    }

    public function review_store(Request $request,$id){
        $request->validate([
            'stars' => 'required',
            'review' => 'required',
        ]);
        OrderProduct::where('customer_id', Auth::guard('customer')->id())->where('product_id',$id)->first()->update([
            'star' => $request->stars,
            'review' => $request->review,
            'updated_at' => Carbon::now(),
        ]);

        return back()->with('review', 'Thanks For The Review');
    }
}
