@extends('production.staff.master')
@php
use App\Order_detail;
use App\Order;
@endphp

@section('body')
<!-- page content -->
<div class="right_col" role="main">
  	<div class="">
	    {{-- <div class="page-title"> --}}
			<div class="col-md-12 col-sm-12 ">
		        <div class="x_panel">
{{-- 		        	<h2 class="">Order Histry Detail
		        		<span class="float-right">
		        			<a href="{{route('staff_0_history')}}" class="btn btn-danger btn-sm" style="border-radius: 20px">
		        			Back
		        			</a>
						</span>
					</h2> --}}
					<div class="container">
					<div class="row row-cols-md-8">						
						<div class="card col">						  
						  <div class="card-body">
					    	<h1 class="text text-white text-center rounded-circle bg-primary" >1</h1>
						    <h6 class="card-text text-center text-primary">admin</h6>
						    <p class="card-text text-center">production</p>
						    <p class="card-text text-center">approve</p>
						  </div>
						</div>
						
						<div class="card col">
						  <div class="card-body">
						    <h1 class="text text-white text-center rounded-circle bg-success">2</h1>
						    <h6 class="card-text text-center text-success">staff</h6>
						    <p class="card-text text-center">procurement</p>
						    <p class="card-text text-center">add price</p>
						  </div>
						</div>

						<div class="card col">
						  <div class="card-body">
						   	<h1 class="text text-white text-center rounded-circle bg-success" >3</h1>
						    <h6 class="card-text text-center text-success">admin</h6>
						    <p class="card-text text-center">procurement</p>
						    <p class="card-text text-center">approve</p>
						  </div>
						</div>

						<div class="card col">
						  <div class="card-body">
						    <h1 class="text text-white text-center rounded-circle bg-danger">4</h1>
						    <h6 class="card-text text-center text-danger">staff</h6>
						    <p class="card-text text-center">finance</p>
						    <p class="card-text text-center">payment</p>
						  </div>
						</div>

						<div class="card col">
						  <div class="card-body">
						    <h1 class="text text-white text-center rounded-circle bg-danger" >5</h1>
						    <h6 class="card-text text-center text-danger">admin</h6>
						    <p class="card-text text-center">finance</p>
						    <p class="card-text text-center">approve</p>
						  </div>
						</div>

						<div class="card col">
						  <div class="card-body">
						    <h1 class="text text-white text-center rounded-circle bg-success">6</h1>
						    <h6 class="card-text text-center text-success">staff</h6>
						    <p class="card-text text-center">procurement</p>
						    <p class="card-text text-center">order</p>
						  </div>
						</div>

						<div class="card col">
						  <div class="card-body">
						    <h1 class="text text-white text-center rounded-circle bg-warning">7</h1>
						    <h6 class="card-text text-center">supplier</h6>
						    <p class="card-text text-center">shipping</p>
						  </div>
						</div>

						<div class="card col">
						  <div class="card-body">
						   	<h1 class="text text-white text-center rounded-circle bg-primary" >8</h1>
						    <h6 class="card-text text-center text-primary">warehouse</h6>
						    <p class="card-text text-center">delivery</p>
						  </div>
						</div>
					</div>
					</div>
		        </div>	    
		   	{{-- </div> --}}
	    </div>

	    <div class="clearfix"></div>
		<div class="col-md-12 col-sm-12 ">
	        <div class="x_panel">
	          	<div class="x_title">
	            	<h2>Delivered Order List <small> Support Lead Time for safe stock </small></h2>
	            	<ul class="nav navbar-right panel_toolbox">
		              	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
		              	<li class="dropdown">
		                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
		                	<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		                    	<a class="dropdown-item" href="">Add New</a> {{-- {{route('inventory.create')}} --}}
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
			                    <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
			                      <thead>
			                        <tr>
			                        	<th class="align-middle text-center">No</th>
			                        	<th class="align-middle text-center">Order Id</th>
			                        	<th class="align-middle text-center">Date</th>
			                        	<th class="align-middle text-center">Status</th>
			                        	<th class="align-middle text-center">Action</th>
			                        </tr>
			                      </thead>


			                      <tbody>
			                      	@php
			                      		$i=0;
			                      	@endphp
			                      	@foreach($orders as $order)
			                        <tr>
			                        	<th class="align-middle text-center">{{++$i}}</th>
										<th class="align-middle text-center">CYD-#{{$order->id}}</th>
			                        	<th class="align-middle text-center">{{$order->date}}</th>
			                        	<th class="align-middle text-center">
			                        	<a href="javascript:void(0)" class="btn text-white text-center rounded-circle 
			                        	@if($order->status_id==1||$order->status_id==8)
			                        	bg-primary
			                        	@elseif($order->status_id==2||$order->status_id==3||$order->status_id==6)
										bg-success
			                        	@elseif($order->status_id==4||$order->status_id==5)
										bg-danger
										@elseif($order->status_id==7)
										bg-warning
			                        	@endif
			                        	" >{{$order->status_id}}</a>

			                        	</th>
			                        	<th class="align-middle text-center">
			                        	<form id="info{{$order->id}}" action="{{route('order_0_info')}}" method="POST" class="d-none">
				                        	@csrf
				                        	@method('GET')
				                        	<input type="text" name="id" value="{{$order->id}}">
			                        	</form>
			                        		<button onclick="document.getElementById('info{{$order->id}}').submit();" class="btn btn-success btn-sm" style="border-radius: 20px">info</button>
			                        	</th>                    		
			                        </tr>
			                        @endforeach
			                      </tbody>
			                    </table> 
	                  		</div>
	                	</div>
	              	</div> 
	            </div>
	        </div>
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
