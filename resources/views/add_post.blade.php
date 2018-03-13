@extends('master')
@section('style')
    <link rel="stylesheet" href="{{ url('src/css/AddPost.css') }}">
 @endsection
@section('maincontent')
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
    @if(\Illuminate\Support\Facades\Session::has('msg'))
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
                <div id="charge_message" class="alert alert-danger">
                    {{ \Illuminate\Support\Facades\Session::get('msg') }};
                </div>
            </div>
        </div>
    @endif
    <div class="container col-md-offset-4" style="margin-top: 30px; margin-bottom: 20px;">

    <form role="form" class="form-group" enctype="multipart/form-data" method="post" action="{{ route('save_post') }}">
        @if (count($errors) > 0)
            <div class="col-md-12">
            <div class="alert alert-danger col-md-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            </div>
        @endif
        <div class="container" id="mycontainer">
            <div class="col-md-6 row ">

                <label for="Name"> Title </label>
                <br />
                <input class="form-control" name="title" id="addname" placeholder="Product Title">
                <br />
            </div>
        </div>

        <div class=" container row" id="mydropdown1">
            <div class="col-md-6 " >
                <label for="filter">Category</label>
                <select class="form-control" id="main_category" name="main_category">
                    <option disabled selected> Select a Category </option>
                    @foreach(App\Category::all() as $main_category)
                        <option value="{{ $main_category->id }}">{{ $main_category->name }}</option>
                     @endforeach
                </select>
            </div>
        </div>
        <div class=" container row" id="mydropdown1">
            <div class="col-md-6 " style="margin-top: 15px;">
                <label for="filter">Generic Category</label>
                <select class="form-control" id="generic_category" name="generic_category">
                    <option disabled selected> Select a Category </option>
                    <option disabled selected>Select A Catagory first</option>
                </select>
            </div>
        </div>
        <div class="container row" id="mydropdown2">
            <div class=" col-md-6" style="margin-top: 15px;">
                <label for="filter">Sub-Category</label>
                <select class="form-control" id="sub_category" name="sub_category">
                    <option disabled selected>Select A Generic Category First</option>
                </select>
            </div>

        </div>

        <div class="container">
            <br />
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong>Upload Images (max 5)</strong>
                        </div>
                        <div class="panel-body">
                            <div class="input-group">
                                       <span class="input-group-btn">
                                           <span class="btn btn-default btn-file">
                                               Browse… <input type="file" class="form-control" name="images[]" multiple id="imgInp">
                                           </span>
                                       </span>
                            </div>


                            <br />

                        </div>

                        <img id='img-upload' />
                    </div>
                </div>



            </div>
        </div>
         <div class="container">
            <br />
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong>Upload Video</strong>
                        </div>
                        <div class="panel-body">
                            <div class="input-group">
                                       <span class="input-group-btn">
                                           <span class="btn btn-default btn-file">
                                               Browse… <input type="file" class="form-control" name="" multiple id="imgInp">
                                           </span>
                                       </span>
                            </div>


                            <br />

                        </div>

                        <img id='img-upload' />
                    </div>
                </div>



            </div>
        </div> 

        <div class="col-md-6">
            <label for="comment">Product details</label>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <textarea class="form-control" rows="5" id="comment" name="product_detail"></textarea>
            <br><br>
            <strong>Price</strong>
            <input class="form-control" name="price" id="addname" placeholder="Price">
            <br>
            <strong>Quantity</strong><br>
            <input class="form-control" name = "quantity" placeholder="Input Quantity">
            <br><br>
            <input type="checkbox" id="make_fb_post" name="make_fb_post" value="1"> Post on My facebook page..<br><br>
            <div id="page_div">
                    {{-- @foreach($page_lists as $page_list)
                        <input type="checkbox" name="selected_page[]" value="{{ $page_list['id'] }}"><label>{{ $page_list['name'] }}</label>
                    @endforeach  --}}
            </div>
            <input type="hidden" id="lat_field" name="lat">
            <input type="hidden" id="lang_field" name="lan">
            <button class="btn btn-default btn-lg pull-right" type="submit" style="background-color: #0F4A0F; color: white;">Post</button>
        </div>

    </form>
    </div>
 @endsection
@section('script')
    <script src="{{ url('src/js/app.js') }}"></script>
    <script src="{{ url('src/js/mapsScript.js') }}"></script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgxw7p_Q87ybcQwSPndmFVL2lsNcfU0MU&callback=initMap">
    </script>

@endsection