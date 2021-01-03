@extends('procurement.staff.master')

@section('body')
	<!-- page content -->
	<div class="right_col" role="main">
	    <div class="page-title">
			<div class="col-md-12 col-sm-12 ">
		        <div class="x_panel">
		        	<h2 class="">Supplier <i class="icofont-building-alt icofont-2x"></i>
		        		<span class="float-right align-items-center">
		        			<a href="{{route('supplier.create')}}">
		        			<i class="fa fa-plus" aria-hidden="true"></i>
		        			 New 		        			
		        			</a>
						</span>
					</h2>
		        </div>	    
		   	</div>
	    </div>

		<div class="col-12 col-sm-12 col-md-12 col-lg-12">
			{{-- <div class="container"> --}}
			<div class="x_panel">
					<table class="table-bordered text-center table-striped" cellpadding="15" width="100%">
						<thead>
							<tr>
								<th>#</th>
								<th class="align-middle text-center">Companey_Name</th>
								<th >Email</th>
								<th>Address</th>
								<th>Phone</th>
								<th>Action</th>
							</tr>
						</thead>
						@php $i=1;  @endphp
						<tbody>
							@foreach($suppliers as $supplier)

								@if ($supplier->id== 1)
								    
								@else
								<tr>
									<td>{{$i++}}</td>
									<td class="align-middle text-left" width="220px">{{$supplier->company_name}}</td>
									<td class="align-middle text-left" width="220px">{{$supplier->email}}</td>
									<td class="align-middle text-left" width="220px">{{$supplier->address}}</td>
									<td class="align-middle text-left">{{$supplier->phone}}</td>
									
									<td>
										<a href="{{route('supplier.edit',$supplier->id)}}" class="btn btn-outline-warning btn-sm"><i class="fa fa-cog" aria-hidden="true"></i></a>
										
										<form action="{{route('supplier.destroy',$supplier->id)}}" method="POST" onsubmit="return confirm('Are you sure want to delete')" class="d-inline">
											@csrf
											@method('DELETE')
											<button type="submit" name="btnsubmit" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
										</form>
									</td>
								</tr>
								@endif
							@endforeach
						</tbody>
					</table>
				</div>
			{{-- </div> --}}
		</div>
	</div>


@endsection
@section('script')
	
@endsection