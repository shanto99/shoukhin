@extends('master')
@section('title')
    Product Detail
@endsection
@section('style')
    <link rel="stylesheet" href="{{ url('src/css/product_detail.css') }}">
    <link rel="stylesheet" href="{{ url('src/css/jquery.bxslider.min.css') }}">
    <link rel="stylesheet" href="{{ url('src/css/rating.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
@section('maincontent')
    <div class="container">
        <div class="card">
            <div class="container-fliud">
                <div class="wrapper row">
                    <div class="preview col-md-8">
                        <div class="preview-pic tab-content">
                            <ul class="bxslider">
                                @for($i = 0; $i<sizeof($product_image_array);$i++)
                                    <li><img src="{{ url($product_image_array[$i]) }}"></li>
                                 @endfor
                            </ul>
                        </div>
                    </div>
                    <div class="details col-md-6">
                        <input type="hidden" id="hidden_id" value="{{ $product_detail->product_id }}">
                        <input type="hidden" id="product_lat" name="product_lat" value="{{ $product_detail->lat }}">
                        <input type="hidden" id="product_lan" name="product_lan" value="{{ $product_detail->lan }}">
                        <h3 class="product-title">{{ $product_detail->title }}</h3>

                        <div class="star-rating">
                            <input id="star-5" class="rate_radio" @if($average_rate == 5) checked @endif type="radio" name="rating" value="5">
                            <label for="star-5" title="5 stars">
                                <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                            <input id="star-4" class="rate_radio" @if($average_rate == 4) checked @endif   type="radio" name="rating" value="4">
                            <label for="star-4" title="4 stars">
                                <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                            <input id="star-3" class="rate_radio" @if($average_rate == 3) checked @endif type="radio" name="rating" value="3">
                            <label for="star-3" title="3 stars">
                                <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                            <input  id="star-2" class="rate_radio" @if($average_rate == 2) checked @endif  type="radio" name="rating" value="2">
                            <label for="star-2" title="2 stars">
                                <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                            <input id="star-1" class="rate_radio" @if($average_rate == 1) checked @endif  type="radio" name="rating" value="1">
                            <label for="star-1" title="1 star">
                                <i class="active fa fa-star" aria-hidden="true"></i>
                            </label>
                    </div>
          
                        <p class="product-description">{{ $product_detail->description }}</p>
                        <h4 class="price">current price: <span>@if(App\Product::where('product_id',$product_detail->product_id)->first()->discount == 1)<strike>{{ App\Offer::where('product_id',$product_detail->product_id)->first()->regular_price }} /= </strike> @endif  {{ App\Product::where('product_id',$product_detail->product_id)->first()->price }}/=    </span></h4>
                        @if(App\Product::where('product_id',$product_detail->product_id)->first()->discount == 1)
                            <h2>Offer Left: {{ $from }} days</h2>
                        @endif
                   {{--      @if(!\Illuminate\Support\Facades\Auth::check())
                            @if($product_detail->offer == 0)
                                <a type="button" class="btn btn-success add-to-cart " href="{{ route('add_to_cart',['id'=>$product_detail->product_id]) }}">Add to Cart</a>
                            @elseif(!$ft_commit>$ft_target && $ft_commit+$st_commit > $st_target)
                                <a type="button" class="btn btn-success add-to-cart " href="{{ route('add_to_cart',['id'=>$product_detail->product_id]) }}">Add to Cart</a>

                            @endif

                            
                        @endif --}}
                     {{--    @if(\Illuminate\Support\Facades\Auth::check())
                            @if($product_detail->user_id != \Illuminate\Support\Facades\Auth::user()->id && $product_detail->discount==1)
                                <div class="action">
                                    
                        
                            <a type="button" class="btn btn-success add-to-cart " href="{{ route('add_to_cart',['id'=>$product_detail->product_id]) }}">Add to Cart</a>
                        
                         @elseif($product_detail->user_id != \Illuminate\Support\Facades\Auth::user()->id && $product_detail->offer == 1)
                         @if($ft_commit<$ft_target || $ft_commit+$st_commit < $st_target)
                            <a type="button" class="btn btn-success add-to-cart " href="{{ route('add_to_cart',['id'=>$product_detail->product_id]) }}">Add to Cart</a>
                         @endif

                            
                         @endif
                                    
                                </div>
                            
                                
                             
                        @endif --}}
                        {{-- @if($product_detail->offer==0)
                            <p><a href="{{ route('add_to_cart',['id'=>$product_detail->product_id]) }}" class="btn btn-success " role="button">Add to Cart</a></p>
                        @endif --}}
                        
                       
                        <br><br>
                        @if($product_detail->offer == 1)
                         @if($ft_commit>=$ft_target || $ft_commit+$st_commit >= $st_target)
                            @if($ft_commit+$st_commit >= $st_target)
                                <p><a href="{{ route('gyb_checkout',['id'=>$product_detail->product_id,'price' => $product_detail->grabtable->st_price]) }}" class="btn btn-danger " role="button">Grab</a></p>
                            @else
                                <p><a href="{{ route('gyb_checkout',['id'=>$product_detail->product_id,'price'=>$product_detail->grabtable->ft_price]) }}" class=" btn btn-danger grab-btn" role="button">Grab</a></p>
                            @endif
                            
                        @else
                            <p><a href="{{ route('add_to_cart',['id'=>$product_detail->product_id]) }}" class="btn btn-success " role="button">Add to Cart</a></p>
                        @endif
                        <br><br>
                        @if($ft_commit < $ft_target)
                        <div class="action">
                                    <a type="button" class="add-to-cart" href="{{ route('commit_check_out',['commit_price'=>$product_detail->grabtable->ft_price,'product_id'=>$product_detail->product_id]) }}">Commit at {{ $product_detail->grabtable->ft_price }}</a>
                          </div>
                          @endif
                          <br><br>
                          <div class="action">
                                    <a type="button" class="add-to-cart" href="{{ route('commit_check_out',['commit_price'=>$product_detail->grabtable->st_price,'product_id'=>$product_detail->product_id]) }}">Commit at {{ $product_detail->grabtable->st_price }}</a>
                          </div>
                          @else

                            <a type="button" class="btn btn-success add-to-cart " href="{{ route('add_to_cart',['id'=>$product_detail->product_id]) }}">Add to Cart</a>
                          @endif

                    </div>
                </div>
            </div>
        </div>
    </div>


    @if($product_detail->offer == 1)
    <div class="container">
    <div class="card">
        <div class="row"><br>
            <div class="col-xs-12">
                <div class="progress">
                    <div class="bar-step" style="left:<?php echo $ft_qty.'%'; ?>">
                        <div class="label-circle">
                            <div class="label-text">{{ $product_detail->grabtable->ft_price }} Taka
                                @if($ft_target == $ft_commit)
                                    Unlocked
                                @endif
                                <br>
                                @if($ft_target>$ft_commit)
                                    {{ $ft_target-$ft_commit }} Need
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="bar-step" style="left: <?php echo $st_qty.'%'; ?>">
                        <div class="label-circle" ><div class="label-text">{{ $product_detail->grabtable->st_price }} Taka
                         @if($st_target == $st_commit+$ft_commit)
                                    Unlocked
                                @endif
                                <br>
                                @if($st_target>$ft_commit+$st_commit)
                                    {{ $st_target-($ft_commit+$st_commit) }} Need
                                @endif

                        </div>
                        </div>
                    </div>
                    @if($ft_commit < $ft_target)
                        <div class="progress-bar" style="width: <?php echo $ft_commit_percent; ?>%;"></div>
                    @endif
                    @if($ft_commit >= $ft_target)
                        <div class="progress-bar progress-bar-custom" style="width: <?php echo $ft_commit_percent; ?>%"></div>
                    @endif
                    @if($st_commit+$ft_commit >= $st_target)
                        <div class="progress-bar progress-bar-custom" style="width: <?php echo $st_commit_percent; ?>%"></div>
                    @endif
                    @if($st_commit+$ft_commit < $st_target)
                        <div class="progress-bar" style="width: <?php echo $st_commit_percent; ?>%"></div>
                    @endif
                    
                    
                </div>
            </div>
        </div>
    </div>

</div>
@endif
<br>
    <center>
        <div id="map" style="height: 50%; width: 50%"></div>
    </center>
@endsection
@section('script')
    <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
    <script src="{{ url('src/js/jquery.bxslider.min.js') }}"></script>
    <script src="{{ url('src/js/app.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.bxslider').bxSlider();
        });
    </script>
    <script src="{{ url('src/js/rating.js') }}"></script>
    <script src="{{ url('src/js/detailPage.js') }}"></script>
    <script>
        function initMap() {

            var pro_lat = parseFloat($('#product_lat').val());
            var pro_lan = parseFloat($('#product_lan').val());
            
            var myLatLng = {lat: pro_lat, lng: pro_lan};

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: myLatLng
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: 'This product Posted from here!!'
            });
        }

    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_fTiwVCJHlq2v-Y8XlBzm8QrtVcvSNEM&callback=initMap">
    </script>

@endsection