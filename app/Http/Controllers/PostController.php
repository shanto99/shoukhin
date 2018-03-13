<?php

namespace App\Http\Controllers;


use App\Cart;
use App\Category;
use App\GenCategory;
use App\Image;
use App\Order;
use App\Product;
use App\Record;
use App\Events;
use App\Events\Event;
use App\Events\Subscription;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Stripe\Stripe;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Stripe\Charge;

class PostController extends Controller
{
    public function route_post(){
        $main_categorys = Category::all();
        $page= Session::get('page_list');
        $page_lists = $page['accounts'];
        return view('add_post',compact('main_categorys','page_lists'));
    }
    public function get_generic_subcat(){
        $main_category_id = Input::get('main_cat_id');
       // return $main_category_id;
        $generic_cats = GenCategory::where('category_id', $main_category_id)->get();
        return $generic_cats;

    }
    public function get_sub_category(){
        $generic_id = Input::get('generic_id');
        $sub_cats = SubCategory::where('gen_category_id',$generic_id)->get();
        return $sub_cats;

    }
    public function save_post(Request $request){
        if(Auth::user()->is_verified != 1){
            return redirect()->route('route_post')->with('msg','You have to be Verified first to post an Ad.');
        }
        $this->validate($request,[
           'title' => 'required|max:50',
            'sub_category' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'product_detail' => 'required|min:20'

        ]);
        $product = new Product();
        $image = new Image();
        $title = $request['title'];
        $main_category = $request['main_category'];
        $gen_category = $request['generic_category'];
        $sub_category = $request['sub_category'];
        $lat = $request['lat'];
        $lan = $request['lan'];
        $detail = $request['product_detail'];
        $price = $request['price'];
        $quantity = $request['quantity'];
        $product->title = $title;
        $product->description = $detail;
        $product->main_category= $main_category;
        $product->generic_category= $gen_category;
        $product->subcatagory_id = $sub_category;
        $product->price = $price;
        $product->quantity = $quantity;
        $product->lat = $lat;
        $product->lan = $lan;
        if($request->hasFile('images')){
            $files = $request->file('images');
            $first_image = 1;
            foreach ($files as $file){
                $file_name = rand(10,10000).time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path().'/product_image/',$file_name);
                $path = '/product_image/'.$file_name;
                if($first_image == 1){
                   $product->image = $path;
                   $request->user()->product()->save($product);
                  // $product = Product::where('title',$title)->where('user_id',Auth::user()->id)->first();
                    $product = DB::table('product')
                        ->orderBy('product_id', 'desc')
                        ->first();
                   $first_image = 0;
                }
                else{
                    $image->image = $path;
                    //$product->image()->save($image);
                    DB::table('image')->insert(['image'=>$path, 'product_id'=>$product->product_id]);
                }
            }
        }
        
        if(isset($_POST['make_fb_post'])){
            $fb = App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');
            $pages = $request['selected_page'];
            $inserted_id = Product::latest()->first()->product_id;
            $message = 'http://localhost:8000/product_detail/'.$inserted_id;
            /*var_dump($pages);*/
            foreach ($pages as $page){

                $api = $fb->post($page.'/feed?'.'POST',array(
                    'access_token' => Session::get('fb_user_access_token'),
                    'message' => $message
                ));
            }
        }
        $inserted_id = Product::latest()->first()->product_id;
        event(new Subscription($title, $inserted_id));
        return redirect()->route('show_profile')->with('success','Your advertise has been posted successfully');
    }
    public function getAddtoCart(Request $request, $id){
        $product = Product::where('product_id',$id)->first();
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->product_id);
        $request->session()->put('cart',$cart);
        return redirect()->route('home');
    }
    public function get_remove_one($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->remove_one($id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }
        return redirect()->route('shoppingCart');
    }
    public function get_remove_all($id){
        /*$oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->remove_all($id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }*/
        Session::forget('cart');
        return redirect()->route('shoppingCart');
    }
    public function showCart(){
        if(!Session::has('cart')){
            return view('shopping_cart',['product' => null]);
        }
        $old_cart = Session::get('cart');
        $cart = new Cart($old_cart);
        return view('shopping_cart',['products'=>$cart->items,'totalPrice' => $cart->totalPrice]);
    }
    public function check_out(){
        if(!Session::has('cart')){
            return redirect()->route('shoppingCart');
        }
        $old_cart = Session::get('cart');
        $cart = new Cart($old_cart);
        $totalPrice = $cart->totalPrice;
        return view('checkout',compact('totalPrice'));
    }
    public function do_checkout(Request $request){
        if(!Session::has('cart')){
            return redirect()->route('shopping_cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);


        Stripe::setApiKey('sk_test_sv78QV4dtXigNgglbAgyaNjC');
        try{
           $charge =  Charge::create(array(
                "amount" => $cart->totalPrice*100,
                "currency" => "bdt",
                "description" => "Example charge",
                "source" => $request->input('stripeToken')
            ));
        }catch (\Exception $e){
            return redirect()->route('check_out')->with('error',$e->getMessage());
        }
        $order = new Order();
        $order->cart = serialize($cart);
        $order->address = $request->input('address');
        $order->name = $request->input('name');
        $order->payment_id = $charge->id;
        Auth::user()->orders()->save($order);
        $record = new Record();
        foreach ($cart->items as $item){
            $product = Product::where('product_id','=',$item['item']['product_id'])->firstOrFail();
            $record = new Record();
            $record->product_id = $item['item']['product_id'];
            $record->quantity = $item['qty'];
            $quan = $item['qty'];

            $product->record()->save($record);
            DB::update("UPDATE product
              SET quantity = quantity - '$quan'
                WHERE product_id = ".$item['item']['product_id']);
            //echo $item['item']['product_id'];
            //echo $item['qty'];
        }
        Session::forget('cart');
        return redirect()->route('home')->with('success','Successfully Purchase!!!');
    }
        public function update_product(Request $request){
        
        $this->validate($request,[
           'title' => 'required|max:50',
            'sub_category' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'product_detail' => 'required|min:20'

        ]);
        $id = $request['edit_product_id'];

        $product = Product::where('product_id',$id)->first();
        $image = new Image();
        $title = $request['title'];
        $main_category = $request['main_category'];
        $gen_category = $request['generic_category'];
        $sub_category = $request['sub_category'];
       
        $detail = $request['product_detail'];
        $price = $request['price'];
        $quantity = $request['quantity'];
        $product->title = $title;
        $product->description = $detail;
        $product->main_category= $main_category;
        $product->generic_category= $gen_category;
        $product->subcatagory_id = $sub_category;
        $product->price = $price;
        $product->quantity = $quantity;
     
        if($request->hasFile('images')){
            foreach (Image::where('product_id')->get() as $img) {
                unlink($img->image);
            }
            $files = $request->file('images');
            $first_image = 1;
            foreach ($files as $file){
                $file_name = rand(10,10000).time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path().'/product_image/',$file_name);
                $path = '/product_image/'.$file_name;
                if($first_image == 1){
                   $product->image = $path;
                   $request->user()->product()->save($product);
                  // $product = Product::where('title',$title)->where('user_id',Auth::user()->id)->first();
                    $product = DB::table('product')
                        ->orderBy('product_id', 'desc')
                        ->first();
                   $first_image = 0;
                }
                else{
                    $image->image = $path;
                    //$product->image()->save($image);
                    DB::table('image')->insert(['image'=>$path, 'product_id'=>$product->product_id]);
                }
            }
        }else{
           Product::where('product_id', $id)
          ->update(['title'=>$title,'description'=>$detail ,'quantity'=>$quantity, 'price'=>$price]);
        }
        
       
        return redirect()->route('show_profile')->with('success','Your advertise has been update successfully');
    }
}
