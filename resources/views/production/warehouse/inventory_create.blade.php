@extends('production.warehouse.master')

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
                <h2>INVENTORY <small>Transection</small></h2>
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
                                          <small>Step 2 description</small>
                                      </span>
                      </a>
                    </li>
                    <li>
                      <a href="#step-3">
                        <span class="step_no">3</span>
                        <span class="step_descr">
                                          Step 3<br />
                                          <small>Step 3 description</small>
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
													<input type="checkbox" class="haha" name="check" data-id="{{$warehouse->id}}">
				                                  </td>
				                                  <td class="align-middle text-center">{{$warehouse->codeno}}</td>
				                                  <td class="align-middle text-left">{{$warehouse->name}}</td>
				                                  <td class="align-middle text-right">{{$warehouse->stock_qty}}</td>
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
				                                  <th class="align-middle text-center" width="50px">No</th>
				                                  <th class="align-middle text-center" width="80px">Code No</th>
				                                  <th class="align-middle text-center" width="200px">Name</th>
				                                  <th class="align-middle text-center">Stock</th>
				                                  <th class="align-middle text-center">Input</th>
				                                  <th class="align-middle text-center">Output</th>
				                                  <th class="align-middle text-center">Unit</th>
				                                </tr>
				                            </thead>
				                            <tbody>
												<tr id="appendhere">
													
												</tr>			                            
				                            </tbody>
				                        </table>
				                    </div>
				                </div>
				            </div>
				        </div>
				    </div>
                  <div id="step-3">
                    <h2 class="StepTitle">Step 3 Content</h2>
                    <p>
                      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                      eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                      in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
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
	$(document).ready(function(){
	    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
		$(document).on('click','input[name=check]',function(){
			var id=$(this).data('id');
			$.ajax({
	            method:"GET",
	            data: {id:id},
	            url: '{{route('inventory.get')}}',
	            success:function(x){
 
	            }
	        })
		})
	})
</script>

@endsection