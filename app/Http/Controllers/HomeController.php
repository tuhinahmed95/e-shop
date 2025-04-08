<?php
namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function user_list()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('admin.user.user_list', compact('users'));
    }

    public function user_delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return back()->with('delete', 'User Delete Successfully');
    }

    public function user_create(){
        return view('admin.user.user_create');
    }

    public function user_store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'confirm_password' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('user.list')->with('User', 'User Add Successfully');
    }


    public function subscriber_list(){
        $subscribers = Subscriber::all();
        return view('admin.subscriber.subscriber_list',compact('subscribers'));
    }
}
