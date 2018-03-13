<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function take_home(){
       /* $users = DB::table('product')
            ->leftJoin('image', 'product.product_id', '=', 'image.product_id')
            ->get();*/
            /*$mains = Category::where('id',1)->first();
            foreach ($mains as $main) {
                return $main->generic_category;
            }*/
       $products = Product::all();
      
       //dd($products);
       return view('home',compact('products'));

    }
    public function route_registration(){
        return view('registration');

    }
    public function do_registration(Request $request){

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:4',
            'confirm_password' => 'required|min:4'
        ]);
        $user = new User();

        $name = $request['name'];
        $email = $request['email'];
        $password = $request['password'];
        $confirm_password = $request['confirm_password'];
        $image = $request['image_field'];
        $is_pro = $request['is_pro'];
        if($password == $confirm_password){
            if(Input::hasFile('image_field')){
                $file = Input::file('image_field');
                $path  = time() . '.' . $image->getClientOriginalExtension();
                $file->move(public_path().'/',$path);
                $user->image = $path;
            }
            $user->name = $name;
            $user->email = $email;
            $user->password = bcrypt($password);
            $verification_code = rand(1,100);
            $user->verification_code = $verification_code;
            if($is_pro){
                $user->is_pro = 1;
            }else{
                $user->is_pro = 0;
            }
            Mail::send('verification',['key'=>$verification_code],function ($message)use($email){
                $message->from('evilldevill623@gmail.com', 'Admin');
                $message->to($email,'User');
                $message->subject("Thanks for Sign Up");
            });
            $user->save();
            Auth::login($user);
            $interested_areas = $request['var_id'];
            $current_user = User::find(Auth::user()->id);
            foreach ($interested_areas as $interested_area){
                $category = Category::find($interested_area);
                $current_user->category()->attach($category);
            }
            if(Session::has('oldUrl')){
                $oldUrl = Session::get('oldUrl');
                Session::forget('oldUrl');
                return redirect()->to($oldUrl);
            }

            return redirect()->route('home');
        }

    }
    public function verification($token){
        if($token == Auth::user()->verification_code){
            $user = User::find(Auth::user()->id);
            $user->is_verified = 1;
            $user->save();
            return redirect()->route('home');
        }
        else{
            return "Invalid token";
        }
    }
    public function route_login(){
        $fb = App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');
        $login_url = $fb->getLoginUrl(['email','publish_pages', 'user_posts', 'user_photos']);
        return view('login',compact('login_url'));
    }
    public function do_login(Request $request){
        $this->validate($request,[
           'email'=>'required|email|exists:users',
            'password'=>'required|min:4'
        ]);
        if(Auth::attempt(['email'=>$request['email'],'password'=>$request['password']])){
            if(Session::has('oldUrl')){
                $oldUrl = Session::get('oldUrl');
                Session::forget('oldUrl');
                return redirect()->to($oldUrl);
            }
            return redirect()->route('home');
        }
        return Redirect::back()
            ->withInput()
            ->withErrors([
                'password' => 'Incorrect password!'
            ]);
    }
    public function facebook_callback(){
        $fb = App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');
        try {
            $token = $fb->getAccessTokenFromRedirect();
        } catch (FacebookResponseException $e) {
            dd($e->getMessage());
        }

        // Access token will be null if the user denied the request
        // or if someone just hit this URL outside of the OAuth flow.
        if (! $token) {
            // Get the redirect helper
            $helper = $fb->getRedirectLoginHelper();

            if (! $helper->getError()) {
                abort(403, 'Unauthorized action.');
            }

            // User denied the request
            dd(
                $helper->getError(),
                $helper->getErrorCode(),
                $helper->getErrorReason(),
                $helper->getErrorDescription()
            );
        }

        if (! $token->isLongLived()) {
            // OAuth 2.0 client handler
            $oauth_client = $fb->getOAuth2Client();

            // Extend the access token.
            try {
                $token = $oauth_client->getLongLivedAccessToken($token);
            } catch (FacebookSDKException $e) {
                dd($e->getMessage());
            }
        }

        $fb->setDefaultAccessToken($token);

        // Save for later
        Session::put('fb_user_access_token', (string) $token);

        // Get basic info on the user from Facebook.
        try {
            $response = $fb->get('/me?fields=id,email');
            $page_list = $fb->get('/me?fields=accounts');
            $page_array = $page_list->getGraphObject()->asArray();
            Session::put('page_list',$page_array);
        } catch (FacebookResponseException $e) {
            dd($e->getMessage());
        }

        // Convert the response to a `Facebook/GraphNodes/GraphUser` collection
        $facebook_user = $response->getGraphUser();

        // Create the user if it does not exist or update the existing entry.
        // This will only work if you've added the SyncableGraphNodeTrait to your User model.
        $user = User::createOrUpdateGraphNode($facebook_user);

        // Log the user into Laravel
        Auth::login($user);
        $user = User::find(Auth::user()->id);
        $user->is_verified = 1;
        $user->save();

        return redirect()->route('home');
    }
    public function log_out(){
        if(Auth::check()){
            Auth::logout();
            return redirect()->route('route_login');
        }
    }
}
