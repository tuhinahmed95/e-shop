<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;


class UserController extends Controller
{
    public function user_profile(){
        return view('admin.user.profile');
    }

    public function user_profile_update(Request $request){
        User::find(Auth::id())->update([
            'name' =>$request->name,
            'email' =>$request->email,
        ]);
        return back()->with('profile', 'User Profile Update Successfully');
    }

    public function user_password_update(Request $request){
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

       $user =  User::find(Auth::id());
       if(Hash::check($request -> current_password, $user->password)){
            $user->update([
                'password' => Hash::make($request->password),
            ]);
            return back()->with('pupdate', 'Password Update Successfully');
       }
       else{
             return back()->with('wrong', 'Password Doesnot Updated');
       }
    }

    public function user_photo_update(Request $request){
        //return $request->all();
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        if(Auth::user()->photo != Null){
            $delete_from = public_path('uploads/user/'.Auth::user()->photo);
            unlink($delete_from);
        }

        $photo = $request->photo;
        $exten = $photo->extension();
        $file_name = Auth::id().'.'.$exten;
        $photo->move(public_path('uploads/user'), $file_name);
        User::find(Auth::id())->update([
            'photo'=> $file_name,
        ]);
        return back()->with('photo','successfully Your profile photo updated');

    }



}
