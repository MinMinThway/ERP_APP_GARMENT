@extends('production.staff.master')
@php
use App\Order_detail;
use App\Order;
use App\Warehouse_detail;
@endphp

@section('body')
<!-- page content -->
<div class="right_col" role="main">
  	<div class="">

	    <div class="clearfix"></div>
		<div class="col-md-12 col-sm-12 ">
	        <div class="x_panel">
	          	<div class="x_title">
	          		<img src="{{asset('logo/index.png')}}" class="float-left">
	          		{{-- <div class="clearfix"></div> --}}
	          		<div class="align-content-center pt-4">
	            	<h2 class="pl-3 text text-dark">σ =Standard Deviation, </h2>
	            	<h2 class="pl-3 text text-dark">μ=population mean, </h2>
	            	<h2 class="pl-3 text text-dark">N=population size</h2>
	            	</div>
	            	<div class="clearfix"></div>
	          	</div>
	          	<div class="x_content">
	              	<div class="row">
	                  	<div class="col-sm-12">
	                    	<div class="card-box table-responsive">
			                    <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
			                      <thead>
			                        <tr>
			                        	<th class="align-middle text-center">code_no</th>
			                        	<th class="align-middle text-center">Name</th>
			                        	<th class="align-middle text-center">Stock</th>
			                        	<th class="align-middle text-success text-center">Mean <h4>μ</h4></th>
			                        	<th class="align-middle text-success text-center">Standard Deviation <h4>σ</h4></th>
			                        	<th class="align-middle text-center">Action</th>
			                        </tr>
			                      </thead>


			                      <tbody>
			                      	@php
			                      	@endphp
			                      	@foreach($warehouses as $warehouse)
			                      	@php
			                      	// $warehouse->stock_qty>0
			                      	$count=Warehouse_detail::where('warehouse_id','=',$warehouse->id)->count();
			                      	if ($count>0) {
			                      		 
			                      	}else{
			                      		continue;
			                      	}
								    $warehouse_detail = Warehouse_detail::select(
								    	DB::raw('sum(output_qty) as total_output'),
								        DB::raw('count(DISTINCT date) as number'),'warehouse_id')
								    			->where('warehouse_id','=',$warehouse->id)
								    			->where('output_qty','>',0)
								                ->groupBy('warehouse_id')
								                ->first();
								    $summation=0;
								    $std_deviation=0;
								    $u=0;
								    if ($warehouse_detail) {						    			
								        $u=$warehouse_detail->total_output/$warehouse_detail->number;
								        $n=$warehouse_detail->number;

									    $warehouse_dates = Warehouse_detail::select(
									    	DB::raw('sum(output_qty) as total'),
									        DB::raw('count(DISTINCT date) as x'),'date')
													->where('warehouse_id','=',$warehouse_detail->warehouse_id)
													->where('output_qty','>',0)
									                ->groupBy('date')
									                ->get();
									    foreach ($warehouse_dates as $datas) {
									    	$x=$datas->total;
									    	$summation+=pow(($x-$u), 2);
									    }
									    $std_deviation=sqrt($summation/$n);
									}
									@endphp
			                        <tr>
			                        	<th class="align-middle text-center">{{$warehouse->codeno}}</th>
										<th class="align-middle text-left">{{$warehouse->name}}</th>
			                        	<th class="align-middle text-center">{{$warehouse->stock_qty}}</th>
										<th class="align-middle text-right">
										@if($u>0)
										<span class="text text-success">
										{{number_format($u,2)}}
										</span>
										@else
										-
										@endif
										</th>
			                        	<th class="align-middle text-right">
			                        	@if($std_deviation>0)
			                        	@if($std_deviation<$u)
										<span class="text text-success">
			                        	{{number_format($std_deviation,2)}}
			                        	</span>
			                        	@else
										<span class="text text-danger">
			                        	{{number_format($std_deviation,2)}}
			                        	</span>
			                        	@endif
										@else
										-
										@endif
			                        	</th>
			                        	<th class="align-middle text-center">
			                        	<form id="info" action="" method="POST" class="d-none">
				                        	@csrf
				                        	@method('GET')
				                        	<input type="text" name="id" value="">
			                        	</form>
			                        		<button onclick="document.getElementById('info').submit();" class="btn btn-info btn-sm" style="border-radius: 20px">info</button>
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
