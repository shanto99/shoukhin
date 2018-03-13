@extends('master')
@section('title')
    Seller's Dashboard
@endsection
@section('style')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
@endsection
@section('maincontent')
    <center>Sell Growth</center>
    <form style="margin-left: 40px">
       <input type="date" name="from_date" id="from_date">
        <input type="date" name="to_date" id="to_date">
        <input type="button" name="submit_date_range" id="submit_date" onclick="getRecord()" value="SHOW" class="btn btn-success">
    </form>
    <div id="bar-example" class="bar-example" style="height: 250px; width: 900px; margin: auto"></div>
    <center><h2>Seller's Products</h2></center>
    <div class="row" style="text-align: center;">
    <div class="col-md-3">
        <h1>shanto</h1>
    </div>
   

        
    </div>
    <div style="text-align: center; padding-left: 40px; padding-right: 40px;" >
        <table id="myTable" class="table table-striped" style="">
            <thead>
            <tr>
                <th>Product Id</th>
                <th>Title</th>
                <th>Quantity</th>
                <th>Value</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->product_id }}</td>
                    <td><a href="{{ route('product_detail',['id'=>$product->product_id]) }}">{{ $product->title }}</a></td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->price }}</td>
                    <td><button type="button" id="btn<?php echo $product->product_id;?>" class="btn btn-primary" @if($product->offer == 1 || $product->discount == 1) disabled  @endif data-toggle="modal" data-target="#<?php echo $product->product_id; ?>">
  Add To deal
</button>
    <div class="modal fade " id="<?php echo $product->product_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add This Product to GYB</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="{{ route('add_to_gyd') }}">
      <div class="row">
          <div class="col-md-6">

              <input type="text" class="form-control" name="product_title" readonly value="{{ $product->title }}">
          </div>
          <div class="col-md-6">
          
              <input type="text" class="form-control" name="product_title" readonly value="{{ $product->price }}">
          </div>
      </div>
      <br>
      <div class="row" style="padding: auto;">
          <div class="col-md-6">
              <img src="{{ \Illuminate\Support\Facades\URL::to($product->image) }}">
          </div>
      </div>
      <br>
      <div class="row">
          <div class="col-md-6">
          <input type="hidden" name="p_id" id="p_id" value="{{ $product->product_id }}">
              <input class="form-control" type="text" id="ft_qty" name="ft_qty">
          </div>
          <div class="col-md-6">
              <input class="form-control" type="text" id="ft_price" name="ft_price">

      </div>
        
      </div>
      <br>
      <div class="row">
          <div class="col-md-6">
              <input class="form-control" required type="text" id="st_qty" name="st_qty">
          </div>
          <div class="col-md-6">
              <input class="form-control" required type="text" id="st_price" name="st_price">

      </div>
        
      </div>
      <input type="date" name="valid_upto">
      <div class="modal-footer">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="btn btn-success" value="Add to GYD">
       
      </div>
      </form>
    </div>
  </div>
</div>
</td>
<td>
  <button type="button" id="disbtn<?php echo $product->product_id;?>" class="btn btn-primary" @if($product->offer == 1 || $product->discount == 1) disabled @endif data-toggle="modal" data-target="#dismodal<?php echo $product->product_id; ?>">
  Add Discount
</button>

<!-- Modal -->
<div class="modal fade" id="dismodal<?php echo $product->product_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Discount To a Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      <div class="row">
          <div class="col-md-6">

              <input type="text" class="form-control" name="product_title" readonly value="{{ $product->title }}">
          </div>
          <div class="col-md-6">
          
              <input type="text" class="form-control" name="product_title" readonly value="{{ $product->price }}">
          </div>
      </div>
      <br>
      <div class="row" style="padding: auto;">
          <div class="col-md-6">
              <img src="{{ \Illuminate\Support\Facades\URL::to($product->image) }}">
          </div>
      </div>
      <br>
    
      <br>
      <div class="row">
      <form method="POST" action="{{ route('add_discount') }}">
          <div class="col-md-6">
              <input class="form-control" type="text" id="discount_percent" name="discount_percent">
          </div>
          <div class="col-md-6">
              
              <input type="date" name="to_date" id="to_date">
              <input type="hidden" name="dis_id" id="dis_id" value="{{ $product->product_id }}">

      </div>
        
      </div>
      <div class="modal-footer">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="btn btn-success" value="Add Discount">
        </form>
      </div>
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
</td>
<td>
  <a href="{{ route('product_edi',['id'=>$product->product_id]) }}" class="btn btn-primary btn-large">Edit</a>
</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('script')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('src/js/dashboard.js') }}">

    </script>
    <script>
      $(document).ready(function() {
  $('#myTable').DataTable();
});

    </script>
@endsection