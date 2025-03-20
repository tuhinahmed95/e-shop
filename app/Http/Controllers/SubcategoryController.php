<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function subcategory_list(){
        $subcategories = Subcategory::all();
        return view('admin.subcategory.subcategory_list', compact('subcategories'));
    }

    public function subcategory_create(){
        $categories = Category::all();
        return view('admin.subcategory.subcategory_create',compact('categories'));
    }

    public function subcategory_store(Request $request){
        $request->validate([
            'category' => 'required',
            'subcat_name' => 'required',
        ]);

        $file_name = '';
        if($request->hasFile('subcat_icon')){
            $subcat_icon = $request->file('subcat_icon');
            $file_name = time(). '.'. $subcat_icon->getClientOriginalExtension();
            $subcat_icon->move(public_path('uploads/subcategory'), $file_name);
        }

        if(Subcategory::where('category_id', $request->category)->where('subcategory_name',$request->subcat_name)->exists()){
            return back()->with('exists', 'Subcategory Already has been exists in Category');
        }
        else{
            Subcategory::create([
                'category_id' => $request->category,
                'subcategory_name' => $request->subcat_name,
                'subcat_icon' => $file_name,
                'created_at' => Carbon::now(),
            ]);

        }

        return redirect()->route('subcategory.list')->with('subcat', 'SubCategory Successfully Added');
    }

    public function subcategory_edit($id){
        $categories = Category::all();
        $subcategory = Subcategory::find($id);
        return view('admin.subcategory.subcategory_edit', compact('categories','subcategory'));
    }

    public function subcategory_update(Request $request, $id){
        $request->validate([
            'category' => 'required',
            'subcat_name' => 'required',
        ]);

        $subcategory = Subcategory::find($id);
        $file_name = $subcategory->subcat_icon;

        if($request->hasFile('subcat_icon')){
            if($subcategory->subcat_icon && file_exists(public_path('uploads/subcategory/'. $subcategory->subcat_icon))){
                unlink(public_path('uploads/subcategory/'.$subcategory->subcat_icon));
            }

            $sub_icon = $request->file('subcat_icon');
            $file_name = time(). '.'. $sub_icon->getClientOriginalExtension();
            $sub_icon->move(public_path('uploads/subcategory'),$file_name);

        }
        $subcategory->update([
            'category_id' => $request->category,
            'subcategory_name' => $request->subcat_name,
            'subcat_icon' => $file_name,
        ]);

        return redirect()->route('subcategory.list')->with('update', 'Subcategory Updated Successfully');
    }

    public function subcategory_delete($id){
        $subcategory = Subcategory::find($id);
        if($subcategory->subcat_icon && file_exists(public_path('uploads/subcategory/'.$subcategory->subcat_icon))){
            unlink(public_path('uploads/subcategory/'.$subcategory->subcat_icon));
        }

        $subcategory->delete();
        return redirect()->route('subcategory.list')->with('delete', 'Subcategory Dleleted!');
    }
}
