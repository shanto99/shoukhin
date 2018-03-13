<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
    Route::get('/',[
        'as' => 'home',
        'uses' => 'HomeController@take_home'
    ]);
    Route::get('/registration',[
        'as' => 'route_registration',
        'uses' => 'HomeController@route_registration'
    ]);
    Route::post('/do_registration',[
        'as' => 'do_registration',
        'uses' => 'HomeController@do_registration'
    ]);
    Route::get('/login',[
        'as' => 'route_login',
        'uses' => 'HomeController@route_login'
    ]);
    Route::post('/do_login',[
        'as' => 'do_login',
        'uses' => 'HomeController@do_login'
    ]);
    Route::get('/fb_login',[
        'as' => 'fb_login',
        'uses' => 'HomeController@fb_login'
    ]);
    Route::get('/facebook/callback',[
        'as' => 'facebook_callback',
        'uses' => 'HomeController@facebook_callback'
    ]);
    Route::get('/log_out',[
        'as' => 'log_out',
        'uses' => 'HomeController@log_out',
        'middleware' => 'auth'
    ]);
    Route::get('/post_an_ad',[
        'as' => 'route_post',
        'uses' => 'PostController@route_post',
        'middleware' => 'auth'
    ]);
    Route::get('/get_generic_category',[
        'as' => 'get_generic_cat',
        'uses' => 'PostController@get_generic_subcat'
    ]);
    Route::get('/get_sub_category',[
        'as' => 'get_sub_category',
        'uses' => 'PostController@get_sub_category'
    ]);
    Route::post('/save_post',[
       'as' => 'save_post',
        'uses' => 'PostController@save_post',
        'middleware' => 'auth'
    ]);
    Route::get('/add-to-cart/{id}',[
        'as' => 'add_to_cart',
        'uses' => 'PostController@getAddtoCart'
    ]);
    Route::get('/shopping_cart',[
       'as' => 'shoppingCart',
        'uses' => 'PostController@showCart'
    ]);
    Route::get('/remove_one/{id}',[
       'as' => 'remove_one',
        'uses' => 'PostController@get_remove_one',
        'middleware' => 'auth'
    ]);
    Route::get('/remove_all/{id}',[
       'as' => 'remove_all',
        'uses' => 'PostController@get_remove_all',
        'middleware' => 'auth'
    ]);
    Route::get('/check_out',[
       'as' => 'check_out',
        'uses' => 'PostController@check_out',
        'middleware' => 'auth',
    ]);
    Route::post('/check_out',[
        'as'=>'do_checkout',
       'uses'=>'PostController@do_checkout',
        'middleware' => 'auth'
    ]);
    Route::get('/show_profile',[
       'as' => 'show_profile',
        'uses' => 'ProfileController@show_profile'
    ]);
    Route::post('/update_profile',[
        'as' => 'update_profile',
        'uses' => 'ProfileController@update_profile'
    ]);
    Route::get('/product_detail/{id}',[
        'as' => 'product_detail',
        'uses' => 'ProductController@product_detail'
    ]);
    Route::get('/verification/{token}',[
        'as'=>'verification',
        'uses' => 'HomeController@verification'
    ]);
 
    Route::get('seller_dashboard',[
        'as' => 'seller_dashboard',
        'uses' => 'SellerController@seller_dashboard'
    ]);
    Route::get('/grab_your_deal',[
       'as' => 'grab_your_deal',
        'uses' => 'ProductController@grab_your_deal'
    ]);
    Route::get('/get_coordinate',[
       'as' => 'get_coordinate',
        'uses' => 'ProductController@get_coordinate'
    ]);
    Route::get('/get_chart_data',[
        'as' => 'get_chart_data',
        'uses' => 'SellerDashboardController@get_chart_data'
    ]);
    Route::get('/get_admin_chart_data',[
        'as' => 'get_admin_chart_data',
        'uses' => 'AdminController@get_chart_data'
    ]);
       Route::get('/get_desired_chart',[
        'as' => 'get_chart_data',
        'uses' => 'SellerDashboardController@get_desired_chart'
    ]);
    Route::get('/forum',[
        'as' => 'forum',
        'uses' => 'ForumController@get_toForum'
    ]);
    Route::post('/forum_save_post',[
        'as' => 'forum_save_post',
        'uses' => 'ForumController@save_post'
    ]);
    Route::post('/comment',[
        'as' => 'comment',
        'uses' => 'ForumController@do_comment'
    ]);
    Route::get('/do_like/{comment_id}',[
        'as' => 'do_like',
        'uses' => 'ForumController@do_like'
        ]);
    Route::get('/do_dislike/{comment_id}',[
        'as' => 'do_dislike',
        'uses' => 'ForumController@do_dislike'
        ]);
    Route::post('/do_subscribe',[
        'uses' => 'ProductController@do_subscribe',
        'as' => 'do_subscribe'
        ]);
    Route::get('/add_to_gyd',[
        'uses' => 'SellerController@add_to_gyd',
        'as' => 'add_to_gyd'
        ]);
     Route::get('/commit_check_out/{commit_price}/{product_id}',[
        'uses' => 'CommitController@commit',
        'as' => 'commit_check_out'
        ]);
     Route::post('/do_commit_checkout/',[
        'uses' => 'CommitController@do_commit_checkout',
        'as' => 'do_commit_checkout'
        ]);
    Route::post('/add_to_gyd/',[
        'uses' => 'SellerController@add_to_gyd',
        'as' => 'add_to_gyd'
        ]);
     Route::get('/gyb_checkout/{id}/{price}',[
       'as' => 'gyb_checkout',
        'uses' => 'CommitController@gyb_checkout',
        'middleware' => 'auth'
    ]);
     Route::post('/do_grab_checkout/',[
        'uses' => 'CommitController@do_grab_checkout',
        'as' => 'do_grab_checkout'
        ]);
     Route::get('/cat_search/{level}/{id}',[
       'as' => 'cate_search',
        'uses' => 'ProductController@cat_search',
        
    ]);
     Route::get('/giving_rating',[
       'as' => 'giving_rating',
        'uses' => 'SellerController@giving_rating'
        
    ]);
     Route::get('/admin_panel',[
       'as' => 'admin_panel',
        'uses' => 'AdminController@get_to_admin'
        
    ]);
     Route::post('/search/',[
        'uses' => 'ProductController@search',
        'as' => 'search'
        ]);
     Route::post('/add_discount',[
        'uses' => 'SellerController@add_discount',
        'as' => 'add_discount'
        ]);
          Route::get('/remove_user_pic',[
        'uses' => 'ProfileController@remove_user_pic',
        'as' => 'remove_user_pic'
     ]);
     Route::post('/add_delivered/',[
        'uses' => 'AdminController@add_delivered',
        'as' => 'add_delivered'
        ]);
      Route::get('/product_edi/{id}',[
        'uses' => 'ProductController@product_edit',
        'as' => 'product_edi'
     ]);
      Route::get('/show_user_profile/{user_id}',[
        'uses' => 'ProfileController@show_user_profile',
        'as' => 'show_user_profile'
        ]);
      Route::post('/update_product',[
        'uses' => 'PostController@update_product',
        'as' => 'update_product'
        ]);


