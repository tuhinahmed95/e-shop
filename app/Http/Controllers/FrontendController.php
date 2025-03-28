<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function welcome(){
        $categories = Category::all();
        $banners = Banner::all();
        return view('frontend.index',compact('categories','banners'));
    }
}
