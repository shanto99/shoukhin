<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Soukhin Admin Panel</title>
  <!-- Bootstrap core CSS-->
  <link href="{{ url('src/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Custom fonts for this template-->
  {{-- <link href="{{ url('src/css/font-awesome.css') }}" rel="stylesheet" type="text/css"> --}}
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="{{ url('src/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
  <link href="{{ url('src/css/sb-admin.css') }}" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">Soukhin</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="index.html">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="charts.html">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Charts</span>
          </a>
        </li>

     
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>

    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Soukhin Dashboard</li>
      </ol>
      <!-- Icon Cards-->
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-comments"></i>
              </div>
              <div class="mr-5">{{ App\VisitCounter::all()->count() }} unique Visitors</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left"></span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-list"></i>
              </div>
              <div class="mr-5">{{ App\User::all()->count() }} Current Users</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left"></span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-shopping-cart"></i>
              </div>
              <div class="mr-5">{{ App\Product::all()->sum('quantity') }} Available Products</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left"></span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-support"></i>
              </div>
              <div class="mr-5">{{ App\Record::all()->sum('quantity') + App\GrabedUser::all()->sum('quantity') }} Sold Products</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left"></span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
      </div>
      <!-- Area Chart Example-->

      <div class="row">
        <div class="col-lg-8">
          <!-- Example Bar Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bar-chart"></i>Sell Growth</div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-8 my-auto">
                  <div id="bar-example" class="bar-example" style="height: 100; width: 50"></div>
                </div>
                <div class="col-sm-4 text-center my-auto">
                  <div class="h4 mb-0 text-primary">{{ $total_amount }}Tk</div>
                  <div class="small text-muted">Total sold amount</div>
                  <hr>
                  <div class="h4 mb-0 text-warning">{{ App\Record::distinct('user_id')->count('user_id') }}</div>
                  <div class="small text-muted">Satisfied Buyer</div>
                  <hr>
                  <div class="h4 mb-0 text-success">{{ App\User::where('is_pro',1)->count() }}</div>
                  <div class="small text-muted">Professional Seller</div>
                </div>
              </div>
            </div>
            
          </div>
          <!-- Card Columns Example Social Feed-->



            <!-- Example Social Card-->

          </div>
          <!-- /Card Columns-->
        </div>
    
      </div>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>Products To be Delivered</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Buyer Name</th>
                  <th>Product Name</th>
                  <th>Quantity</th>
                  <th>Total Price</th>
                  <th>Deliver</th>
                  
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Buyer Name</th>
                  <th>Product Name</th>
                  <th>Quantity</th>
                  <th>Total Price</th>
                  <th>Deliver</th>
                </tr>
              </tfoot>
              <tbody>
              @foreach(App\Record::where('is_delivered',0)->get() as $record)
              <tr>
                  <td><a href="{{ route('show_user_profile',['user_id'=>$record->user_id]) }} }}">{{ App\User::find($record->user_id)->name }}</a></td>
                  <td>{{ App\Product::where('product_id',$record->product_id)->first()->title }}</td>
                  <td>{{ $record->quantity }}</td>
                  <td>{{ App\Product::where('product_id',$record->product_id)->first()->price * $record->quantity }}Taka</td>
                  <td>
                  <form method="POST" action="{{ route('add_delivered',['type'=>'buy','rec_id'=>$record->id]) }}">
                    <input type="hidden" name="delivery_record_id" value="{{ $record->id }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" class="btn btn-success" name="submit" value="Deliver">
                  </form>
                  

                   </td>
                  
                </tr>

              @endforeach
                
       
              </tbody>
            </table>
          </div>
        </div>
       
      </div>
       <div class="card-header">
          <i class="fa fa-table"></i>Products From GYD To be Delivered</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="gydTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Buyer Name</th>
                  <th>Product Name</th>
                  <th>Quantity</th>
                  <th>Total Price</th>
                  <th>Deliver</th>
                  
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Buyer Name</th>
                  <th>Product Name</th>
                  <th>Quantity</th>
                  <th>Total Price</th>
                  <th>Deliver</th>
                </tr>
              </tfoot>
              <tbody>
              @foreach(App\GrabedUser::where('is_delivered',0)->get() as $record)
              <tr>
                  <td><a href="{{ route('show_user_profile',['user_id'=>$record->user_id]) }}">{{ App\User::find($record->user_id)->name }}</a></td>
                  <td>{{ App\Product::where('product_id',$record->product_id)->first()->title }}</td>
                  <td>{{ $record->quantity }}</td>
                  <td>{{ App\Product::where('product_id',$record->product_id)->first()->price * $record->quantity }}Taka</td>
                  <td>
                  <form method="POST" action="{{ route('add_delivered',['type'=>'gyd','rec_id'=>$record->id]) }}">
                    <input type="hidden" name="delivery_record_id" value="{{ $record->id }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" class="btn btn-success" name="submit" value="Deliver">
                  </form>
                  

                   </td>
                  
                </tr>

              @endforeach
                
       
              </tbody>
            </table>
          </div>
        </div>
       
      </div>
    </div>


    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © soukhin.com 2017</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->

    <!-- Bootstrap core JavaScript-->
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="{{ url('src/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ url('src/js/jquery.dataTables.js') }}"></script>
    <script src="{{ url('src/js/sb-admin-datatables.js') }}"></script>
    <script src="{{ url('src/js/admin.js') }}"></script>


  </div>
</body>

</html>
