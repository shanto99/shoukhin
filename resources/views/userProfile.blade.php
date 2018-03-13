@extends('master')
@section('title')
    My Profile
@endsection
@section('style')
    <link rel="stylesheet" href="{{ url('src/css/home.css') }}">
@endsection

@section('maincontent')
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
        <div class="container">
            @if(\Illuminate\Support\Facades\Session::has('error'))
                <div class="row">
                    <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
                        <div id="charge_message" class="alert alert-success">
                            {{ \Illuminate\Support\Facades\Session::get('error') }}
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-lg-6 col-md-6 col-sm-9 col-xs-9 col-md-offset-3">
                <h2>User Profile</h2>
                <img src="{{ \Illuminate\Support\Facades\URL::to( $user_info->image) }}" onerror="this.onerror=null;this.src='{{ url('/src/img/user.png') }}'" class="promo img-responsive" alt="{{ url('/src/img/user.png') }}"  /> 
                <hr><hr>

                <table class="table table-striped">

                    <tbody>

                    <tr>
                        <th scope="row">Name</th>

                        <td class="bg-success">{{ $user_info->name }}</td>
                    </tr>

                    <tr>
                        <th scope="row">Address</th>

                        <td class="bg-info">{{ $user_info->address }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Phone Number</th>

                        <td>{{ $user_info->contact_no }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Interest</th>

                        <td class="bg-success">
                            <ul>
                                @foreach($user_info->category as $cat)
                                    <li>{{ $cat->name }}</li>
                                @endforeach
                            </ul>

                        </td>
                    </tr>
                    </tbody>
                </table>
                <hr>
                <hr>

                <!-- Trigger the modal with a button -->
                @if($user_info->id == \Illuminate\Support\Facades\Auth::user()->id)
                <button type="button" class="btn btn-default btn-md pull-right" data-toggle="modal" data-target="#myModal" style="background-color: #0F4A0F; color: white;">Edit</button>
                @endif
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                <h4 class="modal-title">Edit Your Profile</h4>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('update_profile') }}" method="post" enctype="multipart/form-data">
                                <div class="col-lg-8 col-md-8 col-sm-11 col-xs-11 col-md-offset-2">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <h3 class="panel-title pull-left">Change Your photo</h3>
                                            <a href="{{ route('remove_user_pic') }}" type="button" class="btn btn-sm btn-danger pull-right">Remove Pic</a>
                                            {{-- <button type="button" class="btn btn-sm btn-danger pull-right">Remove Pic</button> --}}
                                            <br><br>
                                            <div align="center">
                                                <div class="col-lg-12 col-md-12">
                                                    <img id='img-upload' class="img-thumbnail img-responsive" onerror="this.onerror=null;this.src='{{ url('/src/img/user.png') }}'" src="{{ $user_info->image }}" width="100px" height="100px">
                                                </div>
                                                <div class="col-lg-12 col-md-12">

                                                        {{-- <input type="file" name = "image_field"  class="form-control"> --}}
                                                        <div class="input-group">
                                                            <span class="input-group-btn">
                                                                <span class="btn btn-default btn-file">
                                                                    Browse <input type="file"  id="imgInp" name = "image_field"  class="form-control">
                                                                </span>
                                                            </span>
                                                            <input type="text"  name = "image_field"  class="form-control" readonly>
                                                        </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-body">

                                                <label for="Name">Name</label>
                                                <input type="text" name="name" class="form-control" id="Name" placeholder="Name" value="{{ $user_info->name }}">
                                        </div>
                                    </div>

                                   {{--  <div class="panel panel-default">
                                        <div class="panel-body">

                                                <label for="Current_Password">Current Password</label>
                                                <input type="password" name="current_password" class="form-control" id="Current_Password" placeholder="Current Password">
                                                <label for="New_Password">New Password</label>
                                                <input type="password" name="new_password" class="form-control" id="New_Password" placeholder="New Password" >
                                                <label for="Confirm_Password">Confirm Password</label>
                                                <input type="password" class="form-control" name="confirm_password" id="New_Password" placeholder="Confirm Password" >

                                        </div>
                                    </div> --}}

                                    <div class="panel panel-default">
                                        <div class="panel-body">

                                                <label for="Your_location">Your location</label>
                                                <input type="text" name="location" class="form-control" id="Your_location" value="{{ $user_info->address }}">
                                                <br>
                                        </div>
                                        <div class="panel-body">

                                            <label for="Your_location">Contact Number:</label>
                                            <input type="text" name="contact_number" class="form-control" id="Your_location" value="{{ $user_info->contact_no }}">
                                            <br>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="panel panel-default">
                                        <div class="panel-body">

                                            <label for="Interest">Interests</label>
                                            <div class="row setup-content" id="step-3">
                                                <div class="col-xs-12 ">
                                                    <div class="col-md-12 col-md-offset-1">


                                                        <div class="row">
                                                            <div class="form-group">
                                                                <div class="searchable-container">
                                                                    @foreach($categorys as $category)
                                                                    <div class="items col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                                                        <div class="info-block block-info clearfix">

                                                                            <div data-toggle="buttons" class="btn-group bizmoduleselect">


                                                                                        <input type="checkbox" @if(in_array($category->id,$selected_array)) checked @endif name="var_id[]" value="{{ $category->id }}">
                                                                                        <h5>{{ $category->name }}</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>




                                                    </div>
                                                </div>
                                            </div>


                                            <!--interest box ends-->


                                        </div>
                                    </div>

                                </div>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button class="btn btn-primary"> Update Profile</button>
                                </form>
                            </div><!--modalbody-->
                            <div class="modal-footer">


                                <br><br>
                                <!--interestbox-->


                            </div><!--modalfooterend-->

                        </div>  <!--fullmodal-->
                    </div>



                </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-8 col-md-offset-2 features-items">
                @if($user_info->id == \Illuminate\Support\Facades\Auth::user()->id)
                    <h2>My Posted Products:</h2><hr>
                  @else
                  
                    <h2>Product Posted By this user: </h2>
                  @endif  
                    @if(App\Product::where('user_id',$user_info->id)->count() <= 0)
                        <h2 style="margin-left: 300px;">Nothing Posted Yet!!</h2>
                    @endif
                    <div class="row col-md-12 col-md-offset-1">
                        @foreach(App\Product::where('user_id',$user_info->id)->get() as $product)
                            <div class="col-md-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <div class="product-image-container">
                                                    <img src="{{ url($product->image) }}" class="product-image"alt="" style="object-fit: scale-down;" />
                                                </div>
                                                <h2>{{ $product->price }}</h2>
                                                <p>{{ $product->title }}</p>
                                                @if($user_info->id == \Illuminate\Support\Facades\Auth::user()->id)
                                                <a href="{{ route('product_edi',['id'=>$product->product_id]) }}" class="btn btn-default add-to-cart"><i class="fa fa-edit"></i>Edit</a>
                                                @endif
                                            </div>
                                            

                                        </div>
                                        
                                    </div>
                                </div>
                        @endforeach
                    </div>
                </div>
            </div>
        
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
            @if($user_info->id == \Illuminate\Support\Facades\Auth::user()->id)
                <h2>My purchase history:</h2><hr>
            @else
                <h2>Purchased history of This user:</h2>

            @endif
                @if(App\Order::where('user_id',$user_info->id)->count() <= 0)
                    <h2 style="margin-left: 300px;">Nothing Purchased Yet!!</h2>
                @endif
                @foreach($orders as $order)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach($order->cart->items as $item)
                            <li class="list-group-item">
                                <span class="badge">{{ $item['price'] }}</span>
                                {{ $item['item']['title'] }} | {{ $item['qty'] }} units
                            </li>
                             @endforeach
                        </ul>
                    </div>
                    <div class="panel-footer">
                        <strong>Total Price: {{ $order->cart->totalPrice }}</strong>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        @section('script')
            <script type="text/javascript">
                $(document).ready( function() {
                    $(document).on('change', '.btn-file :file', function() {
                    var input = $(this),
                        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                    input.trigger('fileselect', [label]);
                    });

                    $('.btn-file :file').on('fileselect', function(event, label) {
                        
                        var input = $(this).parents('.input-group').find(':text'),
                            log = label;
                        
                        if( input.length ) {
                            input.val(log);
                        } else {
                            if( log ) alert(log);
                        }
                    
                    });
                    function readURL(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            
                            reader.onload = function (e) {
                                $('#img-upload').attr('src', e.target.result);
                            }
                            
                            reader.readAsDataURL(input.files[0]);
                        }
                    }

                    $("#imgInp").change(function(){
                        readURL(this);
                    });     
                });
            </script>
        @endsection
@endsection