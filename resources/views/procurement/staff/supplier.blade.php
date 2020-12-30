@extends('procurement.staff.master')

@section('body')
	<!-- page content -->
	<div class="right_col" role="main">
	<h1 class="text text-center text-danger"> supplier table here </h1>
	<a href="{{route('supplier.create')}}" style="float:right;" class="btn btn-outline-primary">Add New Supplier</a>
		<div class="x_panel">
			<div class="container">
				<div class="col-12 col-sm-12 col-md-12 col-lg-12">
					<table class="table-bordered text-center table-striped" cellpadding="15" width="100%">
						<thead>
							<tr>
								<td>#</td>
								<td>Companey_Name</td>
								<td>Email</td>
								<td>Address</td>
								<td>Phone</td>
								<td>Action</td>
							</tr>
						</thead>
						@php $i=1;  @endphp
						<tbody>
							@foreach($suppliers as $supplier)

								@if ($supplier->id== 1)
								    I have one record!
								@else
							
								<tr>
									<td>{{$i++}}</td>
									<td>{{$supplier->company_name}}</td>
									<td>{{$supplier->email}}</td>
									<td>{{$supplier->address}}</td>
									<td>{{$supplier->phone}}</td>
									
									<td>
										<a href="{{route('supplier.edit',$supplier->id)}}" class="btn btn-outline-warning btn-sm">Edit</a>
										
										<form action="{{route('supplier.destroy',$supplier->id)}}" method="POST" onsubmit="return confirm('Are you sure want to delete')" class="d-inline">
											@csrf
											@method('DELETE')
											<input type="submit" name="btnsubmit" class="btn btn-outline-danger btn-sm" value="Delete">
										</form>
									</td>
								</tr>
								@endif
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


@endsection
@section('script')
	
@endsection