<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    public function color_list(){
        $colors = Color::all();
        return view('admin.vairation.color.color_list',compact('colors'));
    }

    public function color_create(){
        return view('admin.vairation.color.color_create');
    }

    public function color_store(Request $request){
        $request->validate([
            'color_name' => 'required',
            'color_code' => 'nullable',
        ]);

        Color::create([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
        ]);

        return redirect()->route('color.list')->with('success', 'Color Added Successfully');
    }

    public function color_edit($id){
        $color = Color::find($id);
        return view('admin.vairation.color.color_edit',compact('color'));
    }

    public function color_update(Request $request, $id){
        $request->validate([
            'color_name' => 'required',
            'color_code' => 'required'
        ]);
        $color = Color::find($id);
        $color->update([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
        ]);
        return redirect()->route('color.list')->with('update', 'Color Updated!');
    }

    public function color_delete($id){
        Color::find($id)->delete();
        return redirect()->route('color.list')->with('delete', 'Color Deleted Successfully');
    }

    public function size_list(){
        $sizes = Size::with('category')->get();
        return view('admin.vairation.size.size_list',compact('sizes'));
    }

    public function size_create(){
        $categories = Category::all();
        return view('admin.vairation.size.size_create',compact('categories'));
    }

    public function size_store(Request $request){
        $request->validate([
            'category_id' => 'required',
            'size_name' => 'nullable',
        ]);

        Size::create([
            'category_id' => $request->category_id,
            'size_name' => $request->size_name,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('size.list')->with('success', 'Size Successfully Added');
    }

    public function size_edit($id){
        $size = Size::find($id);
        $categories = Category::all();
        return view('admin.vairation.size.size_edit', compact('size','categories'));
    }

    public function size_update(Request $request, $id){
        $request->validate([
            'category_id' => 'required',
            'size_name' => 'nullable',
        ]);

        Size::find($id)->update([
            'category_id' => $request->category_id,
            'size_name' => $request->size_name,
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->route('size.list')->with('update', 'Size Updated!');
    }

    public function size_delete($id){
        Size::find($id)->delete();
        return redirect()->route('size.list')->with('delete', 'Size Deleted!');
    }
}
