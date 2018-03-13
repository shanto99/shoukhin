@extends('master')
@section('title')
    Home
@endsection
@section('style')
    <link rel="stylesheet" href="{{ url('src/css/home.css') }}">
@endsection
@section('maincontent')
    <div class="container">
        <div class="jumbotron">

        </div>
        <div class="row col-md-offset-1">
            <div class="gallery col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1 class="gallery-title">Gallery</h1>
            </div>
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
            <div align="center">
                <button class="btn btn-default filter-button" data-filter="all">All</button>
                <button class="btn btn-default filter-button" data-filter="hdpe">Featured</button>
                <button class="btn btn-default filter-button" data-filter="sprinkle">On Deal</button>
                <button class="btn btn-default filter-button" data-filter="spray">On Discount</button>
                <button class="btn btn-default filter-button" data-filter="irrigation">Most Sold</button>
            </div>
            <br/>

            @for($i=0;$i<sizeof($sorted_result);$i++)

                <a href="{{ route('product_detail',['id'=>$sorted_result[$i][0]]) }}"><img height="200px" width="200px" src="{{ \Illuminate\Support\Facades\URL::to($sorted_result[$i][2])  }}"></a>
                {{-- <img height="200px" width="200px" src="{{ \Illuminate\Support\Facades\URL::to($sorted_result[$i][2])  }}"> --}}
                <h4>Title: {{ $sorted_result[$i][1] }}</h4>
                <h3>Distance: {{ $sorted_result[$i][5] }}</h3>
            @endfor


        </div>
    </div>
@section('script')

@endsection
@endsection