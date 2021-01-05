@extends('procurement.staff.master')
@php
use App\Order_detail;
use App\Order;
use App\Supplier;
@endphp

@section('body')
<!-- page content -->
<div class="right_col" role="main">
  	<div class="">

	    <div class="clearfix"></div>

	    <div class="clearfix"></div>
		{{-- <div class="col-md-12 col-sm-12 "> --}}
	        <div class="x_panel">
	          	<div class="x_title">
	            	<h2>Order Request <small>please support price data from suitable supplier</small></h2>
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
			                        	<th class="align-middle text-center">Order_id</th>
			                        	<th class="align-middle text-center" >Date</th>
			                        	<th class="align-middle text-center">Item(nos)</th>
			                        	<th class="align-middle text-center">Supplier</th>
			                        	<th class="align-middle text-center">Action</th>        	
			                        </tr>
			                      </thead>
			                      <tbody>
			                      	@php
			                      		$i=0;
			                      	@endphp
			                      	@foreach($orders as $order)
			                      	@php
			                      		$detail=Order_detail::where('order_id','=',$order->id)->count();
			                      		$suppliers=Supplier::all();
			                      	@endphp

									<tr>
			                        	<td class="align-middle text-center">{{++$i}}</td>
			                        	<td class="align-middle text-center">ERP#{{$order->id}}</td>
			                        	<td class="align-middle text-center" >{{$order->date}}</td>
			                        	<td class="align-middle text-center">{{$detail}}</td>
			                        	<td class="align-middle text-center">
		                        		<select style="height:30px;border-radius: 10px;" id='ed{{$order->id}}' onchange="select('#ed{{$order->id}}','select')">
		                        			@foreach($suppliers as $supplier)

		                        			<option data-oid="{{$order->id}}" value="{{$supplier->id}}" @if($supplier->id==$order->supplier_id) selected @endif>{{$supplier->company_name}}</option>
		                        			@endforeach
		                        		</select>
			                        	</td>
			                        	<td class="align-middle text-center">
			                        		<form action="{{route('order_edit')}}" method="POST">
		                        			@csrf
		                        			@method('GET')
		                        			<input type="hidden" name="id" value="{{$order->id}}"> 
			                        		<button type="submit" class="btn btn-warning" style="border-radius: 20px;">
			                        		edit
			                        		</button>
			                        		</form>
			                        		@if($order->denile_note)
			                        		<button class="btn btn-danger btn-sm" data-id='{{$order->id}}' style="border-radius: 20px;"
											onclick="select('{{$order->id}}','reject')"
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
	    {{-- </div> --}}
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


<script src="{{asset('vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">$('#sampleTable').DataTable();$('.display').DataTable();</script>



<script type="text/javascript">
function select(id,state){
	$(document).ready(function(){
		if (state=='select') {
		var selector=id+' option:selected';
		var order_id=$(selector).data('oid');
		var supplier_id=$(selector).val();

		$.ajax({
			url:'{{route('setsupplier')}}',
			method:'GET',
			data:{oid:order_id,sid:supplier_id},
			success:function(res){
				
			}
		})
		}else if (state=='reject') {
			$.ajax({
			url:'{{route('note_2_get')}}',
			method:'GET',
			data:{id:id},
			success:function(res){
				$('#note').text(res);
				$('#reject').modal('toggle');
			}
		})
		}
	})
}
</script>
@endsection