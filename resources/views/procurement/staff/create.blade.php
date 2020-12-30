@extends('procurement.staff.master')

@section('body')
	<!-- page content -->
	<div class="right_col" role="main">
	    <div class="page-title">
			<div class="col-md-12 col-sm-12 ">
		        <div class="x_panel">
		        	<h2 class="">New Supplier <i class="fa fa-user-circle fa-1x" aria-hidden="true"></i>
		        		<span class="float-right">
		        			<a href="{{route('supplier.index')}}">
		        			<i class="fa fa-angle-double-left fa-2x" aria-hidden="true"></i>
		        			</a>
						</span>
					</h2>
		        </div>	    
		   	</div>
	    </div>
	    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
			<div class="x_panel">
				<div class="container">
					<form action="{{route('supplier.store')}}" method="POST">
						@csrf
						<div class="form-group">
							<label for="company_name">Company_Name</label>
							<input type="text" name="company_name" id="company_name" class="form-control @error('company_name') is-invalid @enderror" value="{{old('company_name')}}">
							@error('company_name')
							    <div class="alert alert-danger">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" name="email" id="company_name" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}">
							@error('email')
							    <div class="alert alert-danger">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<label for="address">Address</label>
							<input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{old('address')}}">
							@error('address')
							    <div class="alert alert-danger">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<label for="phone">Phone</label>
							<input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{old('phone')}}">
							@error('phone')
							    <div class="alert alert-danger">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							 <input type="submit" name="btn-submit" value="Save" class="btn btn-success">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>


@endsection