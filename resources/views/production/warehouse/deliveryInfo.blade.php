@extends('production.warehouse.master')
@php
// use App\Order_detail;
use App\Warehouse;
	// $order= new Order;
	// $order->date='2020-12-15';
	// $order->invoice_no='CNG22343221';
	// $order->total='50';
	// $order->supplier_id=7;
	// $order->status_id=7;
	// $order->save();

	// $order_detail=new Order_detail;
	// $order_detail->qty=10;
	// $order_detail->price='15';
	// $order_detail->UOM='piece';
	// $order_detail->warehouse_id=3;
	// $order_detail->order_id=1;
	// $order_detail->save();

@endphp
@section('body')
<!-- page content -->
<div class="right_col" role="main">
  	<div class="">
	    <div class="page-title">
			<div class="col-md-12 col-sm-12 ">
		        <div class="x_panel">
		        	<h2 class="">Transection <i class="fa fa-exchange" aria-hidden="true"></i>
		        		<span class="float-right">
		        			<a href=""> {{-- {{route('inventory.create')}} --}}
		        			Delivered
		        			<i class="fa fa-plus" aria-hidden="true"></i>
		        			</a>
						</span>
					</h2>
		        </div>	    
		   	</div>
	    </div>

	    <div class="clearfix"></div>

	    <div class="clearfix"></div>
		<div class="col-md-12 col-sm-12 ">
	        <div class="x_panel">
	          	<div class="x_title">
	            	<h2>Order Acceptable List <small>Shipment On The Way</small></h2>
	            	<ul class="nav navbar-right panel_toolbox">
		              	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
		              	<li class="dropdown">
		                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
		                	<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		                    	<a class="dropdown-item" href="">Add New</a> 
		                    	<a class="dropdown-item" href="#">Settings 2</a>
		                  	</div>
		              	</li>
		              	<li><a class="close-link"><i class="fa fa-close"></i></a>
		              	</li>
	            	</ul>
	            	<div class="clearfix"></div>
	          	</div>
	          	<div class="x_content">
	              	<div class="row">
	                  	<div class="col-sm-12">
	                    	<div class="card-box table-responsive">
			                    <table id="" class="table table-striped table-bordered" style="width:100%">
			                      <thead>
			                        <tr>
			                        	<th class="align-middle text-center">No</th>  
			                        	<th class="align-middle text-center">Code No</th>
			                        	<th class="align-middle text-center">Name</th>
			                        	<th class="align-middle text-center">Qty</th>
			                        	<th class="align-middle text-center">Unit</th>			         
			                        </tr>
			                      </thead>


			                      <tbody>
			                      	@php
			                      		$i=0;
			                      	@endphp
			                      	@foreach($order->detail as $data)
			                      	@php
			                      		$warehouse=Warehouse::find($data->warehouse_id);
			                      	@endphp
			                        <tr>
			                        	<th class="align-middle text-center">{{++$i}}</th>  
			                        	<th class="align-middle text-center">{{$warehouse->codeno}}</th>
			                        	<th class="align-middle text-left">{{$warehouse->name}}</th>
			                        	<th class="align-middle text-right">{{$data->qty}}</th>
			                        	<th class="align-middle text-left">{{$data->UOM}}</th>           
			                        </tr>
			                        @endforeach
			                        <form id="deli" action="{{route('delivered')}}" method="POST" class="d-none">
			                        	@csrf
			                        	@method('GET')
			                        	<input type="hidden" name="id" value="{{$order->id}}">
		                        	</form>
			                      </tbody>
			                    </table> 
			                    
	                  		</div>
	                	</div>
	              	</div> 
	            
	            </div>

	        </div>
	    </div>

	    {{-- <div class="clearfix"></div> --}}
	    <div class="pt-3">
	    <button onclick="document.getElementById('deli').submit();" class="btn btn-success pull-right">Delivery</button>
	    </div>
  	</div>
</div>
<!-- /page content -->
@endsection

@section('script')
<!-- Bootstrap -->
<script src="{{asset('vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('vendors/fastclick/lib/fastclick.js')}}"></script>
<!-- NProgress -->
<script src="{{asset('vendors/nprogress/nprogress.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('vendors/iCheck/icheck.min.js')}}"></script>
<!-- Datatables -->
<script src="{{asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
<script src="{{asset('vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
<script src="{{asset('vendors/jszip/dist/jszip.min.js')}}"></script>
<script src="{{asset('vendors/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{asset('vendors/pdfmake/build/vfs_fonts.js')}}"></script>

{{-- <script src="{{asset('build/js/custom.js')}}"></script> --}}

@endsection