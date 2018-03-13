<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class ProfileController extends Controller
{
    public function show_profile(){
        $selected_array = array();
        $user_info = User::find(Auth::user()->id);
        $categorys = Category::all();
        $selected_categorys = Auth::user()->category;
        foreach ($selected_categorys as $selected_category){
            array_push($selected_array,$selected_category->id);

        }
        $orders = Auth::user()->orders;
        $orders->transform(function ($order, $key){
           $order->cart = unserialize($order->cart);
           return $order;
        });
        return view('userProfile',compact('user_info','categorys','selected_array','orders'));
    }
    public function show_user_profile($user_id = null){
        $selected_array = array();
        $user_info = User::find($user_id);
        $categorys = Category::all();
        $selected_categorys = $user_info->category;
        foreach ($selected_categorys as $selected_category){
            array_push($selected_array,$selected_category->id);

        }
        $orders = $user_info->orders;
        $orders->transform(function ($order, $key){
           $order->cart = unserialize($order->cart);
           return $order;
        });
        return view('userProfile',compact('user_info','categorys','selected_array','orders'));
    }
    public function update_profile(Request $request){
        $user = User::find(Auth::user()->id);
        $name = $request['name'];
       // $current_password = $request['current_password'];
        //$new_password = $request['new_password'];
       // $confirm_password = $request['confirm_password'];
        $address = $request['location'];
        $interests = $request['var_id'];
       // if(Hash::check($current_password,$user->password)){
           /* if($new_password != $confirm_password){
                return redirect()->route('show_profile')->with('error','Confirmed Password should be matched with New Password');
            }*/
            $image = $request['image_field'];
            if(Input::hasFile('image_field')){
                if(!empty(Auth::user()->image)){
                    unlink(Auth::user()->image);
                }
                $file = Input::file('image_field');
                $path  = time() . '.' . $image->getClientOriginalExtension();
                $file->move(public_path().'/',$path);
                $user->image = $path;
            }
            $user->name = $name;
            //$user->password = bcrypt($new_password);
            $user->address = $address;
            $user->category()->detach();
            $user->contact_no = $request['contact_number'];
            if(isset($interests)){
                foreach ($interests as $interest){
                $category = Category::find($interest);
                $user->category()->attach($category);
            }
            }
         $user->save();
         return redirect()->route('show_profile')->with('error','Profile Updated Successfully');
        //}
        /*else{
            return redirect()->route('show_profile')->with('error','You have inserted wrong password');
        }*/
    }
    public function remove_user_pic(){
        $user = User::find(Auth::user()->id);
        $user->image = null;
        $user->save();
        return redirect()->route('show_profile');
    }
    
}
