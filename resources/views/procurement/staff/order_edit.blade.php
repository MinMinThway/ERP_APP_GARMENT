@extends('procurement.staff.master')
@php
use App\Order_detail;
use App\Order;
use App\Supplier;
use App\Warehouse;
@endphp

@section('body')
<!-- page content -->
<div class="right_col" role="main">
  	<div class="">

	    <div class="clearfix"></div>

	    <div class="clearfix"></div>
	          	<div class="x_title">
	            	<h2>Go Finish! <small>When supplier and price comfirm.</small></h2>
	            	<ul class="nav navbar-right panel_toolbox">
						<a href="{{route('procurement.staff.order')}}" class="btn btn-info text-white pull-right pt-1">Back</a>
		               	<form id="finish" action="{{route('status_2_change')}}" method="POST">
		               		@csrf
		               		@method('GET')
		               		<input type="hidden" name="id" value="{{$order->id}}">
		               	</form>
						<button onclick="document.getElementById('finish').submit();" class="btn btn-danger pull-right pt-1" href="#">Finish</button>
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
			                        	<th class="align-middle text-center">Codeno</th>
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
			                        	<td class="align-middle text-center">{{++$i}}</td>
			                        	<td class="align-middle text-center">{{$warehouse->codeno}}</td>
			                        	<td class="align-middle text-left">{{$warehouse->name}}</td>
			                        	<td class="align-middle text-right">{{$data->qty}}</td>
			                        	<td class="align-middle text-left">{{$data->UOM}}</td>
			                        	<td class="align-middle text-center">
			                        		@if($data->price)
			                        			<div id="wp2{{$data->id}}" class="float-right pr-5">
				                        			<span id="sp1{{$data->id}}" class='pr-2'>{{$data->price}} $</span>
				                        			<button id="edo{{$data->id}}" onclick="select('#edo{{$data->id}}','edit1')" style="border-radius: 20px" class="btn btn-warning edit"
			                        				data-hdiv='#wp2{{$data->id}}'
			                        				data-sdiv='#np2{{$data->id}}'
				                        			>edit</button>
			                        			</div>
			               			        <div id="np2{{$data->id}}" style="display: none">
			                        		<input id="in2{{$data->id}}" type="number" min='0' step="0.01" name="" value="{{$data->price}}" 
			                        		style="border-radius: 20px;border: none;box-shadow: 1px 1px 1px 1px gray;text-align: right;">
			                        		<a id="pr2{{$data->id}}" href='javascript:void(0)'
			                        			data-id='{{$data->id}}'
			                        			data-input='#in2{{$data->id}}'
			                        			data-np='#np2{{$data->id}}'
			                        			data-wp='#wp2{{$data->id}}'
			                        			data-sp1='#sp1{{$data->id}}'
			                        			data-sp2='#sp2{{$data->id}}'
			                        			onclick="select('#pr2{{$data->id}}','noprice')">
			                        		<i style="position: absolute;" class="icofont-check-circled icofont-2x pl-1 text-success"></i>
			                        		</a>
			                        		</div>
			                        		@else
			                        		<div class="float-right pr-5" id="wp{{$data->id}}" style="display: none">
			                        			<span id="sp2{{$data->id}}" class='pr-2'></span>
			                        			<button id="edt{{$data->id}}" onclick="select('#edt{{$data->id}}','edit2')" style="border-radius: 20px" class="btn btn-warning edit"
			                        				data-hdiv='#wp{{$data->id}}'
			                        				data-sdiv='#np{{$data->id}}'
			                        				>edit</button>
			                        		</div>
			                        		<div id="np{{$data->id}}">
			                        		<input id="in{{$data->id}}" type="number" min='0' step="0.01" name="" 
			                        		style="border-radius: 20px;border: none;box-shadow: 1px 1px 1px 1px gray;text-align: right;">
			                        		<a id="pr{{$data->id}}" href='javascript:void(0)' 
			                        			data-id='{{$data->id}}'
			                        			data-input='#in{{$data->id}}'
			                        			data-np='#np{{$data->id}}'
			                        			data-wp='#wp{{$data->id}}'
			                        			data-sp1='#sp1{{$data->id}}'
			                        			data-sp2='#sp2{{$data->id}}'
			                        			onclick="select('#pr{{$data->id}}','noprice')">
			                        		<i style="position: absolute;" class="icofont-check-circled icofont-2x pl-1 text-success"></i>
			                        		</a>
			                        		</div>
			                        		@endif
			                        	</td>
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
function select(selector,state){
	$(document).ready(function(){
		if (state=='noprice') {
		var id=$(selector).data('id');
		var input=$(selector).data('input');
		var price=$(input).val();

		var np=$(selector).data('np');
		var wp=$(selector).data('wp');
		var sp1=$(selector).data('sp1');
		var sp2=$(selector).data('sp2');

		$.ajax({
			url:'{{route('setprice')}}',
			method:'GET',
			data:{id:id,price:price},
			success:function(price){
				if (price) {
					$(np).hide(1000);
					$(wp).show(1000);
					$(sp1).text(price+' $');
					$(sp2).text(price+' $');
				}
			}
		})
		}else if (state=='edit2') {
		
		var show_div=$(selector).data('sdiv');
		var hide_div=$(selector).data('hdiv');
		$(hide_div).hide(1000);
		$(show_div).show(1000);
		
		}else{
		var show_div=$(selector).data('sdiv');
		var hide_div=$(selector).data('hdiv');
		$(hide_div).hide(1000);
		$(show_div).show(1000);
		}
		// else if(state=='finish'){
		// 	var data=JSON.parse(selector);
		// 	alert('this is finish '+data.name);
		// }
	})

}
</script>
@endsection