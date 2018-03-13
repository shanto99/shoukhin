<?php

namespace App\Http\Controllers;

use App\User;
use App\Product;
use App\Discount;
use App\Rating;
use Illuminate\Http\Request;
use App\Grab;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class SellerController extends Controller
{
    public function seller_dashboard(){
        $user = User::find(Auth::user()->id);
        $products = $user->product()->get();
        return view('dashboard',compact('products'));
    }
    public function add_to_gyd(Request $request){
    	$grab = new Grab();
    	$grab->p_id = $request['p_id'];
    	$grab->ft_qty = $request['ft_qty'];
    	$grab->ft_price = $request['ft_price'];
    	$grab->st_qty = $request['st_qty'];
    	$grab->st_price = $request['st_price'];
        $grab->valid_upto = $request['valid_upto'];
    	$grab->save();
        DB::table('product')->where('product_id',$request['p_id'])->update(['offer'=>1]);
    	return redirect()->route('home');


    }
    public function add_discount(Request $request){
        $p_id = $request['dis_id'];
        $dis_percent = $request['discount_percent'];
        $to_date = $request['to_date'];
        $discount = new Discount($p_id,$dis_percent,$to_date);
        $discount->do_discount();
            return redirect()->route('seller_dashboard');
       
        
    }
    public function giving_rating(){
       $user_id = Auth::user()->id;
        $p_id = Input::get('p_id');
      
       $given_rating = Input::get('rating');
        $is_rated = Rating::where('product_id',$p_id)->where('user_id',$user_id)->count();
        if($is_rated > 0){
            $record = Rating::where('product_id',$p_id)->where('user_id',$user_id)->first();
            $rec = Rating::find($record->id);
            $rec->rate = $given_rating;
            $rec->save(); 

        }else{
            $rating = new Rating();
            $rating->user_id = $user_id;
            $rating->product_id = $p_id;
            $rating->rate = $given_rating;
            $rating->save();
        }

    }
}
