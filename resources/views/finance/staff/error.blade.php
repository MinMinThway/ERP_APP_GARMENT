@extends('finance.staff.master')
@section('body')
<!-- page content -->
<div class="right_col" role="main">
      	<div class="x_title">
        	<h2>Go Back! <small>Please check and Finish again.</small></h2>
        	<ul class="nav navbar-right panel_toolbox">
				<a href="{{route('finance.staff.order')}}" class="btn btn-danger text-white pull-right pt-1">Back</a>
        	</ul>
        	<div class="clearfix"></div>
      	</div>


	<div class="x_content">
	  	<div class="row mt-5">
	  		<div class="col-sm-3"></div>
	      	<div class="col-sm-6 mt-5">
	      		
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  	<h2>  🚨 Not Enough Amount! </h2>
				  	<hr>
				  	
				  	<p>Please fill the bill for the account! First</p>
				  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    	<span aria-hidden="true">&times;</span>
				  	</button>
				</div>
				
			</div>
		</div>
	</div>
	
</div>
<!-- /page content -->
@endsection


