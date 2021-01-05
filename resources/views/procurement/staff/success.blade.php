@extends('procurement.staff.master')
@php
	session_start();
	if (isset($_SESSION['successtitle'])&&isset($_SESSION['success'])) {
		$successtitle=$_SESSION['successtitle'];
		$success=$_SESSION['success'];	
	}
@endphp

@section('body')
<!-- page content -->
<div class="right_col" role="main">
      	<div class="x_title">
        	<h2>Go Back! <small>Please check and Finish again.</small></h2>
        	<ul class="nav navbar-right panel_toolbox">
				<a href="{{route('procurement.staff.order')}}" class="btn btn-danger text-white pull-right pt-1">Back</a>
        	</ul>
        	<div class="clearfix"></div>
      	</div>


	<div class="x_content">
	  	<div class="row mt-5">
	  		<div class="col-sm-3"></div>
	      	<div class="col-sm-6 mt-5">
	      		@if (isset($_SESSION['successtitle'])&&isset($_SESSION['success']))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				  	<h2>  🎉 {{$successtitle}}! 🎉 </h2>
				  	<hr>
				  	<p>{{$success}}</p>
				  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    	<span aria-hidden="true">&times;</span>
				  	</button>
				</div>
				@endif
			</div>
		</div>
	</div>
	@if (isset($_SESSION['successtitle'])&&isset($_SESSION['success']))
	@php
	unset($_SESSION['successtitle']);
	unset($_SESSION['success']);
	@endphp
	@endif
</div>
<!-- /page content -->
@endsection


