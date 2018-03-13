@extends('master')
@section('title')
    Home
@endsection
@section('style')
    <link rel="stylesheet" href="{{ url('src/css/home.css') }}">
@endsection


@section('header-bottom')
        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{ route('home') }}" class="active">Home</a></li>
                                <li class="dropdown"><a href="#">Pets<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Cats</a></li>
                                        <li><a href="shop.html">Dogs</a></li> 
                                        <li><a href="shop.html">Rabbits</a></li>
                                        <li><a href="shop.html">Turtles</a></li>
                                        <li><a href="shop.html">Frogs</a></li>
                                        <li><a href="shop.html">Guinea Pigs</a></li> 
                                        <li><a href="shop.html">Hamster</a></li>
                                        <li><a href="shop.html">Accessories</a></li>
                                        <li><a href="shop.html">Foods</a></li>
                                        <li><a href="shop.html">Others</a></li>
                                    </ul>
                                </li> 
                                <li class="dropdown"><a href="#">Plants<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="#">Aloe</a></li>
                                        <li><a href="#">Money Plant</a></li> 
                                        <li><a href="#">Chinese Evergreen</a></li> 
                                        <li><a href="#">Codiaeum Variegatum</a></li> 
                                        <li><a href="#">Asparagus Fern</a></li> 
                                    </ul>
                                </li> 
                                <li><a href="{{ route('forum') }}">Forum</a></li>
                                <li><a href="contact-us.html">About</a></li>           
                                <li><a href="contact-us.html">Contact Us</a></li>
                            </ul>
                        </div>
                        <div class="dropdown pull-right">
                            <button class="btn btn-success btn-category dropdown-toggle" type="button" data-toggle="dropdown">Category
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                              <li><a tabindex="-1" href="#">HTML</a></li>
                              <li><a tabindex="-1" href="#">CSS</a></li>
                              @foreach(App\Category::all() as $category)
                              <li class="dropdown-submenu">
                                <a class="test" tabindex="-1" href=" {{  route('cate_search',['level'=>'main','id'=>$category->id]) }}">{{ $category->name }}<span class="caret"></span></a>
                                {{-- <a class="test" tabindex="-1" href="#">New dropdown <span class="caret"></span></a> --}}
                                <ul class="dropdown-menu">
                                  <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
                                  <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
                                  <li class="dropdown-submenu">
                                    <a class="test" href="#">Another dropdown <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                      <li><a href="#">3rd level dropdown</a></li>
                                      <li><a href="#">3rd level dropdown</a></li>
                                    </ul>
                                  </li>
                                </ul>
                              </li>
                              @endforeach
                            </ul>
                          </div>
                        </div>

                    </div>
                    <div class="search">
                            <div id="custom-search-input">
                                <div class="input-group col-md-12">
                                    <form method="POST" action="{{ route('search') }}" class="input-group col-md-12" style="margin: 0px;">
                                        <input type="text" class="form-control input-sm" id="search_field" name="search_field" placeholder="search" />
                                        <input type="hidden" name="myLat" id="myLat">
                                        <input type="hidden" name="myLan" id="myLan" >
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <span class="input-group-btn">
                                            <button class="btn btn-info btn-sm" type="submit" id = "search_btn">
                                                <i class="glyphicon glyphicon-search"></i>
                                            </button>
                                        </span>
                                </form>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>
        </div><!--/header-bottom--> 
@endsection

@section('slider')

    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                            <li data-target="#slider-carousel" data-slide-to="3"></li>
                        </ol>
                        
                        <div class="carousel-inner">
                            <div class="item active">
                                
                                <div class="col-sm-12 ">
                                    <img src="{{ url('/src/img/home/pets1.jpg') }}" class="promo img-responsive" alt="" /> 
                                </div>
                            </div>
                            <div class="item">
                                
                                <div class="col-sm-12 center-block">
                                    <img src="{{ url('/src/img/home/plants1.jpg') }}" class="promo img-responsive" alt="" />
                                </div>
                            </div>
                            
                            <div class="item">
                                
                                <div class="col-sm-12 center-block">
                                    <img src="{{ url('/src/img/home/pets2.jpg') }}" class="promo img-responsive" alt="" /> 
                                </div>
                            </div>
                            
                            <div class="item">
                                
                                <div class="col-sm-12">
                                    <img src="{{ url('/src/img/home/plants2.jpg') }}" class="promo img-responsive" alt="" /> 
                                </div>
                            </div>
                            
                        </div>
                        
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>      
    </section><!--/slider-->
@endsection

@section('maincontent')
    <div class="container">
        <div class="row">
            @if(\Illuminate\Support\Facades\Session::has('success'))
                <div class="row">
                    <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
                        <div id="charge_message" class="alert alert-success">
                           {{ \Illuminate\Support\Facades\Session::get('success') }}
                        </div>
                    </div>
                </div>
            @endif
            @if(\Illuminate\Support\Facades\Auth::check())
                @if(\Illuminate\Support\Facades\Auth::user()->is_verified != 1)
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
                            <div id="charge_message" class="alert alert-danger">
                                You are not verified Yet!! Please Go to your email to make your account verified.
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->

                        @foreach(App\Category::all() as $category)
                            <div id="mmain<?php echo $category->id; ?>" class="panel panel-default" >
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordian" href="#<?php echo 'main'.$category->id; ?>">
                                    <span class="badge pull-right"><i class="fa fa-plus"></i></span><a href=" {{  route('cate_search',['level'=>'main','id'=>$category->id]) }}">{{ $category->name }}</a></h4></a>
                                </div>  
                                <div id="<?php echo 'main'.$category->id; ?>" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            @foreach($category->generic_category as $gen_category)
                                                <li>
                                                    <ul>
                                                        <div class="panel-heading">
                                                            <h5 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#mmain<?php echo $category->id; ?>" href="#<?php echo 'gen'.$gen_category->id; ?>"><span class="badge pull-right"><i class="fa fa-plus"></i></span></a><a href=" {{ route('cate_search',['level'=>'gen','id'=>$gen_category->id ]) }} ">{{ $gen_category->name }}</h5></a>
                                                        </div> 

                                                         <div id="<?php echo 'gen'.$gen_category->id; ?>" class="panel-collapse collapse">
                                                            <div class="panel-body">
                                                                <ul>
                                                                    @foreach($gen_category->subcategory as $sub_category)
                                                                        <li>
                                                                            <div class="panel-heading">
                                                                            <a href=" {{ route('cate_search',['level'=>'sub','id'=>$sub_category->id ]) }} ">{{ $sub_category->name }}</h5></a>
                                                                            </div>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </ul>
                                                </li>
                                                {{-- <li><a href="#">Dogs </a></li>
                                                <li><a href="#">Rabbits </a></li>
                                                <li><a href="#">Turtles </a></li>
                                                <li><a href="#">Frogs </a></li>
                                                <li><a href="#">Guinea Pigs </a></li>
                                                <li><a href="#">Hamsters </a></li>
                                                <li><a href="#">Accessories </a></li>
                                                <li><a href="#">Food </a></li>
                                                <li><a href="#">Others </a></li> --}}
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    
                        {{-- <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordian" href="#mens">
                                    <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                    Plants</a></h4>
                            </div>
                            <div id="mens" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                                        <li><a href="#">Aloe</a></li>
                                        <li><a href="#">MOney Plant</a></li>
                                        <li><a href="#">Chinese Evergreen</a></li>
                                        <li><a href="#">Codiaeum Variegatum</a></li>
                                        <li><a href="#">Asparagus Fern</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}
                           
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="{{ route('forum') }}">Forum</a></h4>
                            </div>
                        </div>     
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="#">Grab Your Deal</a></h4>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="#">About</a></h4>
                            </div>
                        </div>
                        
                    </div><!--/category-products-->
                        
                </div>
            </div>
            <div class="col-sm-9">
                <div class="feature-header">
                        <div class="container">
                            <div class="col-sm-offset-1">
                                <button class="btn head-btn filter-button" data-filter="all">All</button>
                                <button class="btn head-btn filter-button" data-filter="hdpe">Featured</button>
                                <button class="btn head-btn filter-button" data-filter="sprinkle">On Deal</button>                            
                                <button class="btn head-btn filter-button" data-filter="spray">On Discount</button>
                                <button class="btn head-btn filter-button" data-filter="irrigation">Most Sold</button>        
                            </div>
                        </div>
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Featured Items</h2>
                    @foreach($products as $product)
                        <div class="gallery_product product_div filter col-sm-3 all @if($product->discount == 1)spray @endif @if($product->offer == 1)sprinkle @endif ">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <div class="product-image-container">
                                            <img src="{{ $product->image }}" class="product-image"alt="" />
                                        </div>
                                        <h2>@if(App\Product::where('product_id',$product->product_id)->first()->discount == 1)<strike>{{ App\Offer::where('product_id',$product->product_id)->first()->regular_price }} /= </strike> @endif  {{ App\Product::where('product_id',$product->product_id)->first()->price }}/=</h2>
                                        <p>{{ $product->title }}</p>
                                        <a href=" {{ route('add_to_cart',['id' => $product->product_id]) }} " class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <div class="product-image-container">
                                                <a href="{{ route('product_detail',['id' => $product->product_id]) }}><img src="{{ url('/src/img/blank.png') }}" class="promo img-responsive" alt="" /></a>
                                            </div>
                                            <h2>@if(App\Product::where('product_id',$product->product_id)->first()->discount == 1)<strike>{{ App\Offer::where('product_id',$product->product_id)->first()->regular_price }} /= </strike> @endif  {{ App\Product::where('product_id',$product->product_id)->first()->price }}/=</h2>
                                            <p>{{ $product->title }}</p>
                                            <a href="{{ route('add_to_cart',['id' => $product->product_id]) }} " class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>            
                                    </div>
                                    @if($product->discount == 1)
                                        <img src="{{ url('/src/img/home/sale.png') }}" class="new" alt="" />
                                    @endif
                                </div>
                            </div>
                        </div>

                    @endforeach
                                
                               {{--  <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <div class="product-image-container">
                                                    <img src="src/img/pets/cat/exotic%20shorthair3.jpg" class="product-image"alt="" />
                                                </div>
                                                <h2>2000tk</h2>
                                                <p>Exotic Short Hair</p>
                                                <a href="#" class="btn btn-default add-to-cart">Grab</a>
                                                <a href="#" class="btn btn-default add-to-cart">Commit</a>
                                            </div>
                                            <div class="product-overlay">
                                                <div class="overlay-content">
                                                    <h2>2000tk</h2>
                                                    <p>Exotic Short Hair</p>
                                                    <a href="#" class="btn btn-default add-to-cart">Grab</a>
                                                    <a href="#" class="btn btn-default add-to-cart">Commit</a>
                                                </div>
                                            </div>
                                            <img src="src/img/home/deal.png" class="new" alt="" />
                                             <div class="progress">
                                                <div class="start color"></div>
                                                <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:70%"></div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div> --}}
                                
                </div><!--features_items-->                   
                        
            </div>
        </div>
    </div>

    <!---new-->
        
    @section('script')
        <script src="{{ url('src/js/home.js') }}"></script>
        <script type="text/javascript">
            $('#search_btn').on("click",function () {
                
                document.getElementById("myLat").value = sessionStorage.getItem("myLat");
                document.getElementById("myLan").value = sessionStorage.getItem("myLan");
                document.search_form.submit();
            });
            $(function() {

              $('.dropdown-menu').on('click', function() {
                var slide_el = $(this).next().find('.sub-dropdown');

                // don't slide up if clicking on the already visible element
                if (!slide_el.is(':visible')) {
                  $('.sub-dropdown').slideUp();
                }
                slide_el.slideToggle(); // only slide clicked element
              });

            });
        </script>
    @endsection
@endsection