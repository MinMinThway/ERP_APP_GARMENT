@extends('production.warehouse.master')

@section('body')
<!-- page content -->
<div class="right_col" role="main">
  	<div class="">
	    <div class="page-title">
			<div class="col-md-12 col-sm-12 ">
		        <div class="x_panel">
		        	<h2 class="">Raw Materils <i class="fa fa-cubes" aria-hidden="true"></i>
		        		<span class="float-right">
		        			<a href="{{route('materials.create')}}">
		        			Add 
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
	            	<h2>Raw Material List <small></small></h2>
	            	<ul class="nav navbar-right panel_toolbox">
		              	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
		              	<li class="dropdown">
		                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
		                	<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		                    	<a class="dropdown-item" href="{{route('materials.create')}}">Add New</a>
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
			                        	<th class="align-middle text-center" width="200px">Name</th>
			                        	<th class="align-middle text-center">Code No</th>
			                        	<th class="align-middle text-center">Photo</th>
			                        	<th class="align-middle text-center">Stock</th>
			                        	<th class="align-middle text-center">Unit</th>
			                        	<th class="align-middle text-center">Lead Time</th>
			                        	<th class="align-middle text-center">Factor</th>
			                        	<th class="align-middle text-center">Action</th>
			                        </tr>
			                      </thead>


			                      <tbody>
			                      	@php
			                      		$i=0;
			                      	@endphp
			                      	@foreach($warehouses as $warehouse)
			                        <tr>
			                        	<td class="align-middle text-center">{{++$i}}</td>
			                        	<td class="align-middle text-left">{{$warehouse->name}}</td>
			                        	<td class="align-middle text-center">{{$warehouse->codeno}}</td>
			                        	<td class="align-middle text-center"><img width="100px" src="{{asset($warehouse->photo)}}"></td>
			                        	<td class="align-middle text-center">{{$warehouse->stock_qty}}</td>
			                        	<td class="align-middle text-center">{{$warehouse->UOM}}</td>
			                        	<td class="align-middle text-center">{{$warehouse->order_time_duration}}</td>
			                        	<td class="align-middle text-center">{{$warehouse->stock_safety_factor}}</td>
			                        	<th class="align-middle text-center">
			                        		<a href="{{route('materials.edit',$warehouse->id)}}" class="btn btn-warning mr-2">
                                            <i class="fa fa-cog" aria-hidden="true"></i>
                                        </a>

                                        <form action="{{route('materials.destroy',$warehouse->id)}}"
                                        onsubmit="return confirm('Are you sure?')" 
                                        method="POST" class="d-inline ml-2">
                                        @csrf
                                        @method('DELETE')
                                            <button class="btn btn-outline-danger">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </form>

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