<html>
    <head>
        <title>
           @yield('title')
        </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        @yield('style')
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prettyPhoto/3.1.6/css/prettyPhoto.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <link rel="stylesheet" href="{{ url('src/css/style.css') }}">
        <link rel="stylesheet" href="{{ url('src/css/main.css') }}">
        <link rel="stylesheet" href="{{ url('src/css/header.css') }}">
        
        <link rel="stylesheet" href="{{ url('src/css/footer.css') }}">
        <link rel="stylesheet" href="{{ url('src/css/responsive.css') }}" >

        <link rel="stylesheet" href="{{ url('src/css/massdrop_style.css') }}" >

        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->

        <link rel="shortcut icon" type="image/png" href="{{{ url ('src/img/home/icon.png') }}}">
    </head>
    <body>

        <header id="header"><!--header-->
            <div class="header_top"><!--header_top-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="contactinfo">
                                <ul class="nav nav-pills">
                                    <li><a href="#"><i class="fa fa-phone"></i> +8801234567890</a></li>
                                    <li><a href="#"><i class="fa fa-envelope"></i> info@shoukheen.com</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="social-icons pull-right">
                                <ul class="nav navbar-nav">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header_top-->

            <div class="header-middle"><!--header-middle-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="logo pull-left">
                                <a href="{{ route('home') }}"><img src="{{ url('src/img/home/logo.png') }}" alt="" />
                                </a>
                            </div>
                             
                        </div>
                        <div class="col-sm-8">
                            <div class="shop-menu pull-right">
                                <ul class="nav navbar-nav">
                                    @if(\Illuminate\Support\Facades\Auth::check())
                                        <li><a href="{{ route('show_profile') }}"><i class="fa fa-user"></i>{{ \Illuminate\Support\Facades\Auth::user()->name }}</a></li>
                                        
                                    @else
                                        
                                        
                                            <li><a href=" {{ route('route_login') }}"><i class="fa fa-lock"></i> Sign In</a></li>
                                        
                                    @endif
                                    
                                    <li><a href="{{ route('check_out') }}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                    <li><a href="{{ route('shoppingCart') }}"><i class="fa fa-shopping-cart"></i> Cart <span class="badge" style="background-color: #0F4A0F">{{ \Illuminate\Support\Facades\Session::has('cart') ? \Illuminate\Support\Facades\Session::get('cart')->quantity : '' }}</span></a></li>
                                    <li><a href="{{ route('route_post') }}">Post An Ad.</a></li>
                                    @if(\Illuminate\Support\Facades\Auth::check())
                                    
                                    <li><a href="{{ route('log_out') }}">Log Out</a></li>
                                    @endif
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header-middle-->
        </header>
        

        @yield('header-bottom')
        @yield('slider')
        @yield('maincontent')
        <footer id="footer"><!--Footer-->
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-sm-12">
                            <div class="single">
                                <br/>
                                <br/>

                                <form method="POST" class="form-group" action="{{ route('do_subscribe') }}">
                                    <div class="input-group">
                                      <input type="text" class="form-control"  required name="porduct_title" placeholder="Enter product name" aria-describedby="basic-addon2">
                                      <span class="input-group-btn"><button class="btn btn-theme" type="submit" name="do_subscribe">Subscribe</button></span>
                                    </div>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>

                                <div class=" searchform">
                                    <p>Get the most recent updates from our site and be updated your self</p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <div class="footer-widget">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="single-widget">
                                <h2>Service</h2>
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="#">Online Help</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                    <li><a href="#">Order Status</a></li>
                                    <li><a href="#">Change Location</a></li>
                                    <li><a href="#">FAQ’s</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="single-widget">
                                <h2>Quock Shop</h2>
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="#">T-Shirt</a></li>
                                    <li><a href="#">Mens</a></li>
                                    <li><a href="#">Womens</a></li>
                                    <li><a href="#">Gift Cards</a></li>
                                    <li><a href="#">Shoes</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="single-widget">
                                <h2>Policies</h2>
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="#">Terms of Use</a></li>
                                    <li><a href="#">Privecy Policy</a></li>
                                    <li><a href="#">Refund Policy</a></li>
                                    <li><a href="#">Billing System</a></li>
                                    <li><a href="#">Ticket System</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="single-widget">
                                <h2>About Shopper</h2>
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="#">Company Information</a></li>
                                    <li><a href="#">Careers</a></li>
                                    <li><a href="#">Store Location</a></li>
                                    <li><a href="#">Affillate Program</a></li>
                                    <li><a href="#">Copyright</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-3 col-sm-offset-1">
                            <div class="single-widget">
                                <h2>About Shoukheen</h2>
                                <form action="#" class="searchform">
                                    <input type="text" placeholder="Your email address" />
                                    <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                    <p>Get the most recent updates from <br />our site and be updated your self...</p>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <p class="pull-left">Copyright © 2017 Shoukheen All rights reserved</p>
                    </div>
                </div>
            </div>
        
        </footer><!--/Footer-->


    <script src="{{ url('src/js/app.js') }}"></script>
    <script src="{{ url('src/js/home.js') }}"></script>
    @yield('script')
    <script>
        $(document).ready(function(){
            $('.dropdown-submenu a.test').on("click", function(e){
                $(this).next('ul').toggle();
                e.stopPropagation();
                e.preventDefault();
            });
            $('#search_btn').on("click",function () {
                
                document.getElementById("myLat").value = sessionStorage.getItem("myLat");
                document.getElementById("myLan").value = sessionStorage.getItem("myLan");
                document.search_form.submit();
            })

        });


    </script>

    <script src="{{ url ('src/js/jquery.scrollUp.min.js') }}"></script> 
    <script src="{{ url ('src/js/price-range.js') }}"></script> 
    <script src="{{ url ('src/js/jquery.prettyPhoto.js') }}"></script> 
    <script src="{{ url ('/src/js/main.js') }}"></script> 

    </body>
</html>