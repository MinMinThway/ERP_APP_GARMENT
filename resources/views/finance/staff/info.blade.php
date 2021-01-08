@extends('finance.staff.master')
@php
// use App\Order_detail;
use App\Warehouse;
use App\Warehouse_detail;
use App\Order_detail;
@endphp
@section('body')
<!-- page content -->
<div class="right_col" role="main">
  	<div class="">
	    <div class="page-title">
			<div class="col-md-12 col-sm-12 ">
		        <div class="x_panel">
		        	<h2 class="">Order History Detail
		        		<span class="float-right">
		        			<a href="{{route('staff_4_history')}}" class="btn btn-danger btn-sm" style="border-radius: 20px">
		        			Back
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
	            	<h2>Delivered List <small></small></h2>
	            	<ul class="nav navbar-right panel_toolbox">
		              	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
		              	<li class="dropdown">
		              	</li>
		              	<li><a class="close-link"><i class="fa fa-close"></i></a>
		              	</li>
	            	</ul>
	            	<div class="clearfix"></div>
	          	</div>

	          	<div class="row">
                        <div class="  invoice-header">
                          <h6 style="margin-left: 15px;">
                              @foreach($order->detail as $data)
                              @php
                              	$detail=Order_detail::where('order_id','=',$order->id)->count();
                                $warehouse=Warehouse::find($data->warehouse_id);
                              @endphp
                              @endforeach
                              <h6 style="margin-left: 15px;"><b>Order Date: {{$order->date}}</b></h6>
                              <h6 style="margin-left: 15px;"><b>Order ID: CYD_# {{$order->id}}</b></h6>
                              <h6 style="margin-left: 15px;"><b>Total Items: {{$detail}}</b></h6>
                              <h6 style="margin-left: 15px;"><b>Cheque No : CNG {{$order->cheque_no}}</b></h6>
                              <h6 style="margin-left: 15px;"><b>Supplier Name: {{$order->supplier->company_name}}</b></h6>
                              
                          </h6>
                        </div>
                        <!-- /.col -->
                      </div>


	          	<div class="x_content">
	              	<div class="row">
	                  	<div class="col-sm-12">
	                    	<div class="card-box table-responsive">
			                    <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
			                      <thead>
			                        <tr>
			                        	<th class="align-middle text-center">No</th>  
			                        	<th class="align-middle text-center">Code No</th>
			                        	<th class="align-middle text-center">Name</th>
			                        	<th class="align-middle text-center">Qty</th>
			                        	<th class="align-middle text-center">Unit</th>
			                        	<th class="align-middle text-center">Unit Price</th>
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
			                        	<th class="align-middle text-right">{{$data->price}} $</th>                      
			                        	
			                        	
			                        	
			                        	
			                        </tr>
			                       
			                      </tbody>
			                       @endforeach
			                      <tfoot>
			                      	
			                      		<th class="align-middle text-center" colspan="5">Total Price</th>
			                      		<th class="align-middle text-right">{{$order->total}} $</th>
			                      	
			                      </tfoot>
			                      
			                    </table> 
			                    
	                  		</div>
	                	</div>
	              	</div> 
	            
	            </div>

	        </div>
	    </div>

	    {{-- <div class="clearfix"a></div> --}}
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