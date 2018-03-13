<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GrabedUser;
use App\Http\Requests;
use App\Product;
use Stripe\Stripe;
use Stripe\Charge;
use App\Usergrab;
use Illuminate\Support\Facades\Auth;
use App\GrabCheckout;
use App\Grab;
use Illuminate\Support\Facades\DB;

class CommitController extends Controller
{
    public function commit($commit_price = null, $product_id = null){
    	return view('commit_check',compact('commit_price','product_id'));
    }
    public function do_commit_checkout(Request $request){
    	$price = $request["price"];
    	$product_id = $request["product_id"];
        
    	Stripe::setApiKey('sk_test_sv78QV4dtXigNgglbAgyaNjC');
        try{
           $charge =  Charge::create(array(
                "amount" => $price*100,
                "currency" => "bdt",
                "description" => "Example charge",
                "source" => $request->input('stripeToken')
            ));
        }catch (\Exception $e){
            //return redirect()->route('check_out')->with('error',$e->getMessage());
            return $e->getMessage();
        }
        $user_grab = new Usergrab();
        $user_grab->user_id = Auth::user()->id;
        $user_grab->p_id = $product_id;
        $user_grab->quantity = 1;
        $user_grab->dealing_amount = $price;
        $user_grab->grab_id = Product::where('product_id',$product_id)->first()->grabtable->id;
        $user_grab->save();
        
        $test = array();
        $grab_deal = Grab::where('p_id', $product_id)->first();
         $first_amount = $grab_deal->ft_price;
         
        $first_target = $grab_deal->ft_qty;
        
      
         $second_amount = $grab_deal->st_price;
         
        $second_target = $grab_deal->st_qty;
        
        
        $commit_ft = Usergrab::where('grab_id', $grab_deal->id)->where('dealing_amount',$first_amount)->sum('quantity');
        if(!$commit_ft)
            $commit_ft = 0;
        
        $commit_st = Usergrab::where('grab_id', $grab_deal->id)->where('dealing_amount',$second_amount)->sum('quantity');
        if(!isset($commit_st))
            $commit_st = 0;
        
        
        if($commit_st >= $second_target){
            
           $grab_users = Usergrab::where('grab_id', $grab_deal->id)->where('dealing_amount',$second_amount)->get();
            foreach ($grab_users as $grab_user) {
                DB::table('grabed_users')->insert(['user_id'=>$grab_user->user_id, 'product_id'=>$grab_user->p_id,'price'=>$grab_user->dealing_amount,'quantity'=>$grab_user->quantity,'deal_id'=>$grab_user->grab_id]);
            }

        }
        elseif($commit_ft>=$first_target && $commit_st < $second_target){
            $al_g = array();
            $already_grabeds = GrabedUser::where('deal_id',$grab_deal->id)->get();
            
           foreach ($already_grabeds as $already) {
               array_push($al_g, $already->user_id);
           }
             $grab_users = Usergrab::where('grab_id', $grab_deal->id)->where('dealing_amount',$first_amount)->whereNotIn('user_id',$al_g)->get();
            foreach ($grab_users as $grab_user) {
                DB::table('grabed_users')->insert(['user_id'=>$grab_user->user_id, 'product_id'=>$grab_user->p_id,'price'=>$grab_user->dealing_amount,'quantity'=>$grab_user->quantity,'deal_id'=>$grab_user->grab_id]);
            }

        }


        return redirect()->route('home');
    }
    public function gyb_checkout($id=null, $price = null){

        return view('grab_checkout',compact('id', 'price'));
    }
    public function do_grab_checkout(Request $request){
        $id = $request["product_id"];
        $price = $request["product_price"];
       Stripe::setApiKey('sk_test_sv78QV4dtXigNgglbAgyaNjC');
        try{
           $charge =  Charge::create(array(
                "amount" => $price*100,
                "currency" => "bdt",
                "description" => "Example charge",
                "source" => $request->input('stripeToken')
            ));
        }catch (\Exception $e){
            return redirect()->route('home')->with('error',$e->getMessage());
        }
        
        $gcheckout = new GrabedUser();
        $gcheckout->user_id = Auth::user()->id;
        $gcheckout->product_id = $id;
        $gcheckout->price = $price;
        $gcheckout->quantity = 1;
        $gcheckout->save();
        return redirect()->route('home');
    }
}
