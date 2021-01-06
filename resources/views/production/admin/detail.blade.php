@extends('production.admin.master')
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
	            	<h2>Order Request <small>please click detail for check and approve</small></h2>
	            	<ul class="nav navbar-right panel_toolbox">
		              	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
		              	<button data-toggle="modal" data-target="#reject" type="submit" class="btn btn-danger btn-sm" style="border-radius: 20px;">
                		Reject
                		</button>
                  		<form action="{{route('status_3_change')}}" method="POST" class="d-inline">
		               		@csrf
		               		@method('GET')
		               		<input type="hidden" name="id" value="{{$order->id}}">		               	
		               	<button type="submit" class="btn btn-success btn-sm" style="border-radius: 20px;">
                		approve
                		</button>
                		</form>
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
			                        	<th class="align-middle text-center" width="10%">No</th>
			                        	<th class="align-middle text-center" width="10%">Code No</th>
			                        	<th class="align-middle text-center" width="30%">Name</th>
			                        	<th class="align-middle text-center" width="20%">Stock Left</th>
			                        	<th class="align-middle text-center" width="10%">Order qty</th>
			                        	<th class="align-middle text-center" width="10%">Unit</th>
			                        </tr>
			                      </thead>
			                      <tbody>
			                      	@php
										$i=0;
			                      	@endphp
			                      	@foreach($order->detail as $item)
									<tr>
			                        	<td class="align-middle text-center">{{++$i}}</td>
			                        	<td class="align-middle text-center">{{$item->warehouse->codeno}}</td>
			                        	<td class="align-middle text-left" >{{$item->warehouse->name}}</td>
			                        	<td class="align-middle text-right" >{{$item->warehouse->stock_qty}}</td>
			                        	<td class="align-middle text-right">{{$item->qty}}</td>
				                        <td class="align-middle text-left">{{$item->UOM}}</td>
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

<!-- Modal -->
<div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="exampleModalLabel">Reject Note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('production.admin.order.reject')}}" method="POST">
      	@csrf
      	@method('GET')
      	<input type="hidden" name="id" value="{{$order->id}}">
      <div class="modal-body">
        <textarea class="text" style="width: 100%;text-align: left;" name="note">
        	Please give reason about reject. clearly define what you want to check again!
        </textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Reject</button>
      </div>
      </form>
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
	$(document).ready(function(){

	})
	                
</script>
@endsection