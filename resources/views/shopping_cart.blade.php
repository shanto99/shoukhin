@extends('master')
@section('title')
    Shopping Cart
@endsection
 @section('maincontent')
   {{-- @if(\Illuminate\Support\Facades\Session::has('cart'))
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <ul class="list-group">
                    @foreach($products as $product)
                        <li class="list-group-item">
                            <span class="badge">{{ $product['qty'] }}</span>
                            <strong>{{ $product['item']['title'] }}</strong>
                            <img src="{{ url($product['image']) }}" height="50px" width="50px">
                            <span class="label label-success">{{ $product['price'] }}</span>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">Action<span class="caret">

                                    </span>

                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="btn btn-warning" href="{{ route('remove_one',['id'=>$product['item']['product_id']]) }}">Remove 1</a></li>
                                    <li><a class="btn btn-warning" href="{{ route('remove_all',['id'=>$product['item']['product_id']]) }}">Remove All</a></li>
                                </ul>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <strong>Total: {{ $totalPrice }}</strong>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <a style="float: right" href="{{ route('check_out') }}" type="button" class="btn btn-success">Checkout</a>
                <a style="float: left" href="{{ route('home') }}" type="button" class="btn btn-success">Continue Shopping</a>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <h2>You have not selected any Item!!!</h2>
            </div>
        </div>
    @endif --}}

    @if(\Illuminate\Support\Facades\Session::has('cart'))
        <div class="container-fluid" style="margin-top: 20px;">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <div class="row">
                                    <div class="col-xs-2" style="color: white;">
                                        <h5><span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                             @foreach($products as $product)

                            <div class="row">
                                <div class="col-xs-2"><img src="{{ url($product['image']) }}" height="70px" width="100px">
                                </div>
                                <div class="col-xs-4">
                                    <h4 class="product-name"><strong>{{ $product['item']['title'] }}</strong></h4><h4><small>Product description</small></h4>
                                </div>
                                <div class="col-xs-6">
                                    <div class="col-xs-6 text-right">
                                        <h6><strong>{{ $product['item']['price'] }}TK <span class="text-muted">x</span></strong></h6>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control input-sm" value="{{ $product['qty'] }}">
                                    </div>
                                    <div class="col-sm-2" style="margin-top: 10px;">
                                        <a href="{{ route('remove_one',['id'=>$product['item']['product_id']]) }}"><span class="glyphicon glyphicon-trash" style="color: red;"> </span></a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @endforeach
                            <div class="row">
                                <div class="text-center">
                                    <div class="col-xs-9">
                                        <h6 class="text-right">Add items?</h6>
                                    </div>
                                    <div class="col-xs-3">
                                        <a href="{{ route('home') }}" type="button" class="btn btn-default btn-sm btn-block"><span class="glyphicon glyphicon-share-alt"></span> Continue Shopping</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="check-footer">
                        <div class="col-xs-3">
                            <a href="{{ route('remove_all',['id'=>$product['item']['product_id']]) }}" type="button" class="btn btn-danger btn-outline-danger"><span class="glyphicon glyphicon-trash"></span> Empty Cart</a>
                        </div>

                        <div class="col-xs-7 text-right">
                            <h4 class="">Total <strong>{{ $totalPrice }}TK</strong></h4>
                        </div>
                        <div class="col-xs-1">
                            <a href="{{ route('check_out') }}" type="button" class="btn btn-success btn-bock">Checkout</a>
                                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <hr>
    @else
        <div class="container text-center">

            <div style="display:inline-block; vertical-align:top;">
                <img src="src/img/cart/sad.PNG" class="promo img-responsive" alt="" />
            </div>
            <div style="display:inline-block; vertical-align:top; padding-top: 200px;">
                <div><h2>Your cart is empty.</h2></div>
            </div>
            {{-- <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3 text-center">
                
            </div> --}}
            <hr/>
            <br/>
            <div>
                <a href="{{ route('home') }}" type="button" class="btn btn-success btn-mlg" style="margin-bottom: 60px"><span class="glyphicon glyphicon-share-alt"></span> Continue Shopping</a>
            </div>
        </div>
    @endif
@endsection