@extends('production.staff.master')
@php
use App\Order_detail;
use App\Order;
@endphp

@section('body')
<!-- page content -->
<div class="right_col" role="main">
  	<div class="">

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
			                        	<button style="border-radius: 25px" class="btn btn-sm text-white
			                        	@if($order->status_id==1||$order->status_id==8)
			                        	btn-primary
			                        	@elseif($order->status_id==2||$order->status_id==3||$order->status_id==6)
										btn-success
			                        	@elseif($order->status_id==4||$order->status_id==5)
										btn-danger
										@elseif($order->status_id==7)
										btn-warning
			                        	@endif
			                        	" 
			                        	>
			                        	@if($order->status_id==1)
			                        	admin-production
			                        	@elseif($order->status_id==2)
			                        	staff-procurement
			                        	@elseif($order->status_id==3)
			                        	admin-procurement
			                        	@elseif($order->status_id==4)
			                        	staff-finance
			                        	@elseif($order->status_id==5)
			                        	admin-finance
			                        	@elseif($order->status_id==6)
			                        	order-state
			                        	@elseif($order->status_id==7)
			                        	shipping
			                        	@else
			                        	delivery
			                        	@endif

			                        	{{-- {{$order->status_id}} --}}
			                        	</button>

			                        	</th>
			                        	<th class="align-middle text-center">
			                        	<form id="info{{$order->id}}" action="{{route('order_0_info')}}" method="POST" class="d-none">
				                        	@csrf
				                        	@method('GET')
				                        	<input type="text" name="id" value="{{$order->id}}">
			                        	</form>
			                        		<button onclick="document.getElementById('info{{$order->id}}').submit();" class="btn btn-info btn-sm" style="border-radius: 20px">info</button>
			                        		@if($order->denile_note&&$order->status_id==1)
			                        		<button name='reject' class="btn btn-danger btn-sm" data-id='{{$order->id}}' style="border-radius: 20px;"
			                        		>Rejected</button>
			                        		@endif
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
<div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="exampleModalLabel">Reject Note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="note">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
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

<script type="text/javascript">
	$(document).ready(function(){
	    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
		$(document).on('click','button[name=reject]',function(){
			var id=$(this).data('id');
			$.ajax({
			url:'{{route('note_0_get')}}',
			method:'GET',
			data:{id:id},
			success:function(res){
				$('#note').text(res);
				$('#reject').modal('toggle');
				}
			});
		})
	})
</script>

@endsection
