@extends('production.staff.master')

@section('body')
<style type="text/css">
	.haha {
    display: inline-block;
    *display: inline;
    vertical-align: middle;
    margin: 0;
    padding: 0;
    width: 20px;
    height: 20px;
    border-radius: 15;
    /*background: green;*/
    border: none;
    cursor: pointer;
}
</style>
    <!-- page content -->
    <div class="right_col" role="main">
	    <div class="page-title">
			<div class="col-md-12 col-sm-12 ">
		        <div class="x_panel">
		        	<h2 class="">New Transection <i class="fa fa-exchange" aria-hidden="true"></i>
		        		<span class="float-right">
		        			<a href="{{route('inventory.index')}}">
		        			<i class="fa fa-angle-double-left fa-2x" aria-hidden="true"></i>
		        			</a>
						</span>
					</h2>
		        </div>	    
		   	</div>
	    </div>
      <div class="">

        <div class="row">

          <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
              <div class="x_title">
                <h2>Order <small>Creating</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Settings 1</a>
                      </li>
                      <li><a href="#">Settings 2</a>
                      </li>
                    </ul>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">


                <!-- Smart Wizard -->
                {{-- <p>This is a basic form wizard example that inherits the colors from the selected scheme.</p> --}}
                <div id="wizard" class="form_wizard wizard_horizontal">
                  <ul class="wizard_steps">
                    <li>
                      <a href="#step-1">
                        <span class="step_no">1</span>
                        <span class="step_descr">
                                          Step 1<br />
                                          <small>Choose Materials</small>
                                      </span>
                      </a>
                    </li>
                    <li>
                      <a href="#step-2">
                        <span class="step_no">2</span>
                        <span class="step_descr">
                                          Step 2<br />
                                          <small>Input Ammout</small>
                                      </span>
                      </a>
                    </li>
                    <li>
                      <a href="#step-3">
                        <span class="step_no">3</span>
                        <span class="step_descr">
                                          Step 3<br />
                                          <small>Check</small>
                                      </span>
                      </a>
                    </li>
                  </ul>
                  <div id="step-1"> {{-- step-1 start --}}
	                   <div class="row">
				        <div class="col-md-12">
				            <div class="tile">
				                <div class="tile-body">
				                    <div class="table-responsive">
				                        <table class="table table-hover table-striped display">
				                            <thead style="background-color: #3f5367" class="text-white">
				                                <tr>
				                                  <th class="align-middle text-center" width="50px">
				                                  	{{-- <input type="checkbox" name=""> --}}
													<input type="checkbox" class="haha" name="all" style="position: absolute; opacity: 0;">
				                                  </th>
				                                  <th class="align-middle text-center">Code No</th>
				                                  <th class="align-middle text-center">Name</th>
				                                  <th class="align-middle text-center">Stock</th>
				                                  <th class="align-middle text-center">Unit</th>
				                                </tr>
				                            </thead>
				                            <tbody>
				                                @foreach ($warehouses as $warehouse)                            
				                                <tr>				                                	
				                                  <td class="align-middle text-center">
													<input type="checkbox" class="haha" id='id{{$warehouse->id}}' name="check" check='0' data-id="{{$warehouse->id}}">
				                                  </td>
				                                  <td class="align-middle text-center">{{$warehouse->codeno}}</td>
				                                  <td class="align-middle text-left">{{$warehouse->name}}</td>
				                                  <td id='st{{$warehouse->id}}' class="align-middle text-right">{{$warehouse->stock_qty}}</td>
				                                  <td class="align-middle text-left">{{$warehouse->UOM}}</td>
				                                </tr>
				                                @endforeach				                            
				                            </tbody>
				                        </table>
				                    </div>
				                </div>
				            </div>
				        </div>
				    </div>

                  </div> {{-- step-1 end --}}
                  	<div id="step-2">
	                 	<div class="row">
				        	<div class="col-md-12">
				            	<div class="tile">
				                	<div class="tile-body">
				                    	<div class="table-responsive">
				                        	<table class="table table-hover table-striped display">
					                            <thead style="background-color: #3f5367" class="text-white">
					                                <tr>
					                                  <th class="align-middle text-center" >Code No</th>
					                                  <th class="align-middle text-center" >Name</th>
					                                  <th class="align-middle text-center">warehouse</th>
					                                  <th class="align-middle text-center" >Order</th>
					                                  {{-- <th class="align-middle text-center" width="50px">Output</th> --}}
					                                  <th class="align-middle text-center">Unit</th>
					                                  <th class="align-middle text-center">Action                           	  </th>
					                                </tr>
					                            </thead>
					                            <tbody id="appendhere">
						                            <tr></tr>
					                            </tbody>
				                        	</table>
				                    	</div>
				                	</div>
				            	</div>
				        	</div>
				    	</div>
				    </div>
                <div id="step-3">
		          	<div class="x_content">
		              	<div class="row">
		                  	<div class="col-sm-12">
		                    	<div class="card-box table-responsive">
				                    <table id="" class="table table-striped table-bordered display" style="width:100%">
				                      <thead style="background-color: #3f5367" class="text-white">
				                       	<tr>
		                                  <th class="align-middle text-center" >Code No</th>
		                                  <th class="align-middle text-center" >Name</th>
		                                  <th class="align-middle text-center" >Warehouse</th>
		                                  <th class="align-middle text-center" >Order</th>
		                                  <th class="align-middle text-center">Unit</th>
		                                  <th class="align-middle text-center">Action</th>
		                                </tr>
				                      </thead>
				                      <tbody id="appendhere2">
				                      	<tr>
				                      		
				                      	</tr>
				                      </tbody>
				                    </table>
				                    <div class="my-5"></div>
				                    <button name="order" class="btn btn-info pull-right">Order Confirm</button>
				                    <div class="my-5"></div>
		                  		</div>
		                	</div>
		              	</div> 
		            </div>
                </div>
                <!-- End SmartWizard Content -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /page content -->
</div>	
@endsection

@section('script')
<script src="{{asset('vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">$('#sampleTable').DataTable();$('.display').DataTable();</script>

<script type="text/javascript">
	var old=localStorage.getItem('order');
	$(document).ready(function(){
		setInterval(check,1000);
		ifChange();
		function check(){
			var current=localStorage.getItem('order');
			if (old!=current) {
				ifChange();
				old=current;
			}	
		}
		
	    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

		$(document).on('click','input[name=check]',function(){
			var id=$(this).data('id');
			var state=$(this).attr('check');
			var tr_id='#id'+id; // parent
			var tr_ids='#ids'+id; // check
			if (state=='0') {
		        $.ajax({
		            url:'{{route('inventory_get')}}',
		            method:"GET",
		            data:{id:id},
		            success:function(data){
		            	if(data){
				            var array=JSON.parse(data);
				            if (array.stock_qty==null) {
				            	var stock ='';
				            } else {
				            	var stock = array.stock_qty;
				            }
				            // var no=$("#appendhere").children().length;
				            var html=`<tr id='ids${array.id}' data-id='${array.id}'>
			                    <th class="align-middle text-center" >${array.codeno}</th>
			                    <th class="align-middle text-center" >${array.name}</th>
			                    <th class="align-middle text-center">${stock}</th>
			                    <th class="align-middle text-center"><input id='qty${array.id}' min='0' type="number" name="Input" class='w-50' value='0'></th>
			                    <th class="align-middle text-left">${array.UOM}</th>
                              	<th>
                              	<button class="btn btn-success" name="checkOut" 
									data-id='${array.id}'
									data-qty='#qty${array.id}'
									data-code='${array.codeno}'
									data-name='${array.name}'
									data-unit='${array.UOM}'
									data-stock='${stock}'
									>
								Add Order</button>
                              	</th>
			                    </tr>`;
			                $('#appendhere').append(html);
			                $(tr_id).attr('check','1');
				            }	
		            	}
		        });
		    }else{
		    	$(tr_id).attr('check','0');
		    	$(tr_ids).remove();
		    }
		})
               // <th class="align-middle text-center" width="50px"><input id='op${array.id}' min='0' type="number" name="Output"></th>

        // this is 
		$(document).on('click','button[name=checkOut]',function(){
			var id=$(this).data('id');
			var input_id=$(this).data('qty');
			// var output_id=$(this).data('output');
			var input=$(input_id).val();
			// var output=$(output_id).val();
			var tr_ids='#ids'+id;
			var chk_id='#id'+id;
			var st_id='#st'+id; // check
			//for report
			var code=$(this).data('code');
			var name=$(this).data('name');
			var unit=$(this).data('unit');
			var stock=$(this).data('stock');

			var mylocal='order';
			var myString=localStorage.getItem(mylocal);
			var myData={
				warehouse_id:id,
				qty:input,
				UOM:unit,
				stock:stock,
				codeno:code,
				name:name,
			};
			var hit=false;
			if (myString) {
				var myArray=JSON.parse(myString);
				for (x in myArray) {
					if (myArray[x].warehouse_id==id) {
						myArray[x].qty=parseInt(myArray[x].qty)+parseInt(input);
						hit=true;
					}
				}
				if (hit) {

				}else{
					myArray.push(myData);					
				}
			}else{
				var myArray=[];
				myArray.push(myData);				
			}
			localStorage.setItem(mylocal,JSON.stringify(myArray));
			$(tr_ids).remove();
        	$(chk_id).click();
		})
        // this is
    function ifChange(){

    	var mylocal='order';
		var myArray=JSON.parse(localStorage.getItem(mylocal));
		var html='';
		if(myArray){
			for (x in myArray) {
    	html+=`<tr>
                  <th class="align-middle text-center" >${myArray[x].codeno}</th>
                  <th class="align-middle text-left" >${myArray[x].name}</th>
                  <th class="align-middle text-right" >${myArray[x].stock}</th>
                  <th class="align-middle text-center" >${myArray[x].qty}</th>
                  <th class="align-middle text-left">${myArray[x].UOM}</th> 
                  <th class="align-middle text-center">
                  <button class='btn btn-outline-warning'>edit</button>
                  </th>
                </tr>`;				
			}
		}
	$('#appendhere2').html('');
    $('#appendhere2').append(html);
    }

	$(document).on('click','button[name=order]',function(){
		alert('ha ha'); //ajax.
	});


	})// readyfunction

</script>

@endsection

