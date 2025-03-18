<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category_list(){
        $categories = Category::simplePaginate(5);
        return view('admin.category.category_list',compact('categories'));
    }

    public function category_create(){
        return view('admin.category.category_create');
    }

    public function category_store(Request $request){

        $request->validate([
            'category_name' => 'required',
            'icon' =>'required',
        ]);

        if($request->hasFile('icon')){
            $icon = $request->file('icon');
            $file_name = time(). '.' . $icon->getClientOriginalExtension();
            $icon->move(public_path('uploads/category/'), $file_name);

        }

        Category::create([
            'category_name' => $request->category_name,
            'icon' => $file_name,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('category.list')->with('category_c', 'Category Added Successfully');
    }

    public function category_edit($id){
        $category = Category::find($id);
        return view('admin.category.category_update',compact('category'));
    }

    public function category_update(Request $request , $id){
        $request->validate([
            'category_name' => 'required',
        ]);

        if($request->icon == ''){
            Category::find($id)->update([
                'category_name' => $request->category_name,
            ]);

        }
        else{
            $cat = Category::find($id);
            $cat_img = public_path('uploads/category/' . $cat->icon);
            unlink($cat_img);

            if($request->hasFile('icon')){
                $icon = $request->file('icon');
                $file_name = time(). '.' . $icon->getClientOriginalExtension();
                $icon->move(public_path('uploads/category/'), $file_name);

            }

            Category::find($id)->update([
                'caetegory_name' => $request->category_name,
                'icon' => $file_name,
            ]);

            return redirect()->route('category.list')->with('category_update', 'Category Updated Successfully');
        }


    }

    public function category_soft_delete($id){
        Category::find($id)->delete();
        return back()->with('soft_delete', 'Category Move To Trash');
    }

    public function category_trash_list(){
        $categories = Category::onlyTrashed()->get();
        return view('admin.category.category_trash',compact('categories'));
    }

    public function category_restore($id){
        Category::onlyTrashed()->find($id)->restore();
        return back()->with('restore', 'Category Restored');
    }

    public function category_permanent_delete($id){
       $cat = Category::onlyTrashed()->find($id);

       $cat_img = public_path('uploads/category/'.$cat->icon);
       unlink($cat_img);

       Category::onlyTrashed()->find($id)->forceDelete();
       return back()->with('permanent_delete', 'Category Deleted Permanently');

    }

    public function checked_category_trash(Request $request){
      foreach($request->category_id as $category){
        Category::find($category)->delete();

      }
      return back()->with('check_trash', 'Trash Checked Successfully');
    }

    public function checked_category_restore(Request $request){
        print_r($request->category_id);
        foreach($request->category_id as $category){
            Category::onlyTrashed()->find($category)->restore();

        }
        return back()->with('check_restore', 'Restore Checked Successfully');
    }
}
