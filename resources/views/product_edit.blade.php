@extends('master')
@section('title')
    Product Edit
@endsection

@section('style')

@endsection

@section('maincontent')

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
    	<h1>Edit Product</h1>
    	<hr/>

	    <form role="form" class="form-group" enctype="multipart/form-data" method="post" action="{{ route('update_product') }}">
	    <input type="hidden" name="edit_product_id" value="{{ $product->product_id }}">
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
	                <input class="form-control" name="title" id="addname" placeholder="Product Title" value="{{ $product->title }}">
	                <br />
	            </div>
	        </div>

	        <div class=" container row" id="mydropdown1">
	            <div class="col-md-6 " >
	                <label for="filter">Category</label>
	                <select class="form-control" id="main_category" name="main_category">
	                    <option disabled selected> Select a Category </option>
	                    @foreach(App\Category::all() as $main_category)
	                        <option @if($product->main_category == $main_category->id) selected="selected" @endif value="{{ $main_category->id }}">{{ $main_category->name }}</option>
	                     @endforeach
	                </select>
	            </div>
	        </div>
	        <div class=" container row" id="mydropdown1">
	            <div class="col-md-6 " style="margin-top: 15px;">
	                <label for="filter">Generic Category</label>
	                <select class="form-control" id="generic_category" name="generic_category">
	                    <option disabled selected> Select a Category </option>
	                    @foreach(App\GenCategory::where('category_id',$product->main_category)->get() as $gen_cats)
	                    	<option @if($product->generic_category == $gen_cats->id) selected="selected" @endif value="{{ $gen_cats->id }}">{{ $gen_cats->name }}</option>
	                    @endforeach
	                </select>
	            </div>
	        </div>
	        <div class="container row" id="mydropdown2">
	            <div class=" col-md-6" style="margin-top: 15px;">
	                <label for="filter">Sub-Category</label>
	                <select class="form-control" id="sub_category" name="sub_category">
	                	@foreach(App\SubCategory::where('gen_category_id',$product->generic_category)->get() as $sub_cats)
	                		<option @if($product->subcatagory_id == $sub_cats->id) selected="selected" @endif value="{{ $sub_cats->id }}">{{ $sub_cats->name }}</option>
	                	@endforeach
	                    
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
	            <textarea class="form-control" rows="5" id="comment" name="product_detail">{{ $product->description }}</textarea>
	            <br><br>
	            <strong>Price</strong>
	            <input class="form-control" name="price" id="addname" placeholder="Price" value="{{ $product->price }}">
	            <br>
	            <strong>Quantity</strong><br>
	            <input class="form-control" name = "quantity" placeholder="Input Quantity" value="{{ $product->quantity }}">
	            <br><br>
	            
	            <input type="hidden" id="lat_field" name="lat">
	            <input type="hidden" id="lang_field" name="lan">
	            <button class="btn btn-default btn-lg pull-right" type="submit" style="background-color: #0F4A0F; color: white;">Save Change</button>
	        </div>

	    </form>
    </div>
	@section('script')
	    <script src="{{ url('src/js/app.js') }}"></script>
	    <script src="{{ url('src/js/mapsScript.js') }}"></script>
	    <script async defer
	            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgxw7p_Q87ybcQwSPndmFVL2lsNcfU0MU&callback=initMap">
	    </script>

	@endsection

 @endsection