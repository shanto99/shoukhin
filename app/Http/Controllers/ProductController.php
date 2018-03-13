<?php

namespace App\Http\Controllers;

use App\Product;
use App\Offer;
use App\Usergrab;
use App\Rating;
use Illuminate\Http\Request;
use App\subscribe;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Category;

class ProductController extends Controller
{
    public function product_detail($id){
        $commit_qty = 0;
        $product_image_array = array();
        $product_detail = Product::where('product_id',$id)->first();
        $rating_count = Rating::where('product_id',$id)->count();
        
        $total_rate =  Rating::where('product_id',$id)->sum('rate');
        
        if($rating_count > 0)
            $average_rate = $total_rate/$rating_count;
        else
            $average_rate = 0;
        
        $product_images = $product_detail->image()->get();
        foreach ($product_images as $product_image){
            array_push($product_image_array,$product_image->image);
        }
        array_push($product_image_array,$product_detail->image);
        if($product_detail->offer == 1){
        $ft_target = $product_detail->grabtable->ft_qty;

        $st_target = $product_detail->grabtable->st_qty;
        $ft_qty = $ft_target/($ft_target+$st_target)*100;
        $st_qty = $st_target/($ft_target+$st_target)*100;
        $ft_commit = Usergrab::where('p_id',$id)->where('dealing_amount',$product_detail->grabtable->ft_price)->sum('quantity');
        $st_commit = Usergrab::where('p_id',$id)->where('dealing_amount',$product_detail->grabtable->st_price)->sum('quantity');
        if(!isset($st_commit))
            $st_commit = 0;
        if(!isset($ft_commit))
            $ft_commit = 0;
        
       
        $committs = Usergrab::where('p_id',$id)->get();
        foreach ($committs as $committ) {
            $commit_qty+=$committ->quantity;
        }
        $ft_commit_percent = $ft_commit/($ft_target+$st_target)*100;
        $st_commit_percent = $st_commit/($ft_target+$st_target)*100;
        
        return view('product_detail',compact('product_detail','product_image_array','ft_qty','st_qty','ft_commit_percent','st_commit_percent','ft_target','st_target','ft_commit','st_commit','average_rate'));
    }elseif($product_detail->discount == 1){
        $from = Offer::where('product_id',$id)->first()->start_at;
        $to = Offer::where('product_id',$id)->first()->ends_at;
        $diff = abs(strtotime($from) - strtotime($to));
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $from = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        return view('product_detail',compact('product_detail','product_image_array','from','average_rate'));  
    }else{
     return view('product_detail',compact('product_detail','product_image_array','average_rate'));   
    }
    }
    public function search(Request $request){
        $search_result = array();
        $key = $request['search_field'];
        //return $key;
       $key_array = explode("-",$key);
        //dd($key_array);
        if(sizeof($key_array) ==2 && is_numeric($key_array[0])&& is_numeric($key_array[1]) ){
            $products = DB::table('product')
                ->whereBetween('price', array($key_array[0], $key_array[1]))->get();
           // return view('home',compact('products'));
        }
        elseif (is_numeric($key)){
            $products = Product::where('price',$key)->get();
            //return view('home',compact('products'));
        }
        else{
            $products = Product::where('title','LIKE','%'.$key.'%')->get();
        }
        //dd($products);
        $i = 0;
        foreach ($products as $product){

            $j = 0;
            
        $request_url = "http://maps.googleapis.com/maps/api/distancematrix/xml?origins=".$request["myLat"]."+".$request["myLan"]."&destinations=".$product->lat."+".$product->lan."&sensor=false";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $content =  curl_exec($ch);
           /* $content = file_get_contents($request_url);*/
           /*var_dump($content);
           dd($content);*/
            if (false != $content) {
                $xml = simplexml_load_string($content);
            }
            else {
                exit('Failed to retrieve contents from request_url.');
            }
            $search_result[$i][$j] = $product->product_id;
            $j++;
            $search_result[$i][$j] = $product->title;
            $j++;
            $search_result[$i][$j] = $product->image;
            $j++;
            $search_result[$i][$j] = $product->price;
            $j++;
            $search_result[$i][$j] = $xml->row->element->distance->value;
            $j++;
            $search_result[$i][$j] = $xml->row->element->distance->text;
            $i++;
        }
        curl_close($ch);

        $sorted_result = $this->sort_by_distance($search_result);
       // print_r($search_result);
       //dd($sorted_result);
        return view('search',compact('sorted_result'));
    }
    public function sort_by_distance($search_result){
        for($i=0; $i<sizeof($search_result)-1;$i++){
            for ($j=0;$j<sizeof($search_result)-$i-1; $j++){
                if((int)$search_result[$j][4]>(int)$search_result[$j+1][4]){
                    $swap = $search_result[$j];
                    $search_result[$j] = $search_result[$j+1];
                    $search_result[$j+1] = $swap;
                }
            }
        }
        return $search_result;
        //dd($search_result);
    }
    public function grab_your_deal(){
        return view('grab_your_deal');
    }
    public function do_subscribe(Request $request){
        $subscribe = new subscribe();
        $title = $request['porduct_title'];
        $subscribe->product = $title;
        $request->user()->subscribe()->save($subscribe);
        return redirect()->route('home');

    }
    public function cat_search($level = null, $id = null){
        if($level == 'main'){
            $products = Product::where('main_category',$id)->get();
            return view('home',compact('products'));

        }
        if($level == 'gen'){
            $products = Product::where('generic_category',$id)->get();
            return view('home',compact('products'));

        }
        if($level == 'sub'){
            $products = Product::where('subcatagory_id',$id)->get();
            return view('home',compact('products'));

        }
    }
    public function product_edit($id = null){
        $product = Product::where('product_id',$id)->first();
        return view('product_edit',compact('product'));
    }
        public function update_product(){
        $commit_qty = 0;
        $product_image_array = array();
        $product_detail = Product::where('product_id',$id)->first();
        $rating_count = Rating::where('product_id',$id)->count();
        
        $total_rate =  Rating::where('product_id',$id)->sum('rate');
        
        if($rating_count > 0)
            $average_rate = $total_rate/$rating_count;
        else
            $average_rate = 0;
        
        $product_images = $product_detail->image()->get();
        foreach ($product_images as $product_image){
            array_push($product_image_array,$product_image->image);
        }
        array_push($product_image_array,$product_detail->image);
        if($product_detail->offer == 1){
        $ft_target = $product_detail->grabtable->ft_qty;

        $st_target = $product_detail->grabtable->st_qty;
        $ft_qty = $ft_target/($ft_target+$st_target)*100;
        $st_qty = $st_target/($ft_target+$st_target)*100;
        $ft_commit = Usergrab::where('p_id',$id)->where('dealing_amount',$product_detail->grabtable->ft_price)->sum('quantity');
        $st_commit = Usergrab::where('p_id',$id)->where('dealing_amount',$product_detail->grabtable->st_price)->sum('quantity');
        if(!isset($st_commit))
            $st_commit = 0;
        if(!isset($ft_commit))
            $ft_commit = 0;
        
       
        $committs = Usergrab::where('p_id',$id)->get();
        foreach ($committs as $committ) {
            $commit_qty+=$committ->quantity;
        }
        $ft_commit_percent = $ft_commit/($ft_target+$st_target)*100;
        $st_commit_percent = $st_commit/($ft_target+$st_target)*100;
        
        return view('product_detail',compact('product_detail','product_image_array','ft_qty','st_qty','ft_commit_percent','st_commit_percent','ft_target','st_target','ft_commit','st_commit','average_rate'));
    }elseif($product_detail->discount == 1){
        $from = Offer::where('product_id',$id)->first()->start_at;
        $to = Offer::where('product_id',$id)->first()->ends_at;
        $diff = abs(strtotime($from) - strtotime($to));
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $from = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        return view('product_detail',compact('product_detail','product_image_array','from','average_rate'));  
    }else{
     return view('product_detail',compact('product_detail','product_image_array','average_rate'));   
    }
    }
}
