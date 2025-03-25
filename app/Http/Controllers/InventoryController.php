<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function add_inventory($id){
        $product = Product::find($id);
        $colors = Color::all();
        $inventories = Inventory::where('product_id',$id)->get();
        return view('admin.product.inventory',compact('product','colors','inventories'));
    }

    public function inventory_store(Request $request,$id){
        $request->validate([
            'color_id' => 'nullable',
            'size_id' => 'nullable',
            'quantity' => 'required',
        ]);

        if(Inventory::where('product_id',$id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->exists())
        {
            Inventory::where('product_id',$id,)->where('color_id',$request->color_id,)->where('size_id',$request->size_id)->increment('quantity',$request->quantity);
            return back();
        }
        Inventory::create([
            'product_id' => $id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'quantity' => $request->quantity,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('inventory', 'Inventory Successfully Added');

    }

    public function inventory_delete($id){
        Inventory::find($id)->delete();
        return back()->with('delete', 'Inventory Deleted!');
    }


}
