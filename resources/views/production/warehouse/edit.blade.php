@extends('production.warehouse.master')

@section('body')
<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
		<div class="col-md-12 col-sm-12 ">
	        <div class="x_panel">
	        	<h2 class="">Create New Material</i>
	        		<span class="float-right">
	        			<a href="{{route('materials.index')}}">
	        			<i class="fa fa-angle-double-left fa-2x" aria-hidden="true"></i>
	        			</a>
					</span>
				</h2>
	        </div>	    
	   	</div>
    </div>
	
	<div class="clearfix"></div>
			<div class="col-md-12 col-sm-12 ">
				<div class="x_panel">
					<div class="x_content">
						<br />
						<form action="{{route('materials.update',$warehouse->id)}}" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="codeno">Code No <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" id="codeno" name="codeno" class="form-control @error('codeno') is-invalid @enderror" value="@error('codeno') {{old('codeno')}} @else {{$warehouse->codeno}} @enderror">
									@error('codeno')
										<div class="text text-danger">{{$message}}</div>
									@enderror
								</div>
							</div>
							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Name <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="@error('name') {{old('name')}} @else {{$warehouse->name}} @enderror">
									@error('name')
										<div class="text text-danger">{{$message}}</div>
									@enderror
								</div>
							</div>
							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="photo">Photo <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="file" id="photo" name="photo" class="form-control-file @error('photo') is-invalid @enderror">
									<img class="img-fluid" id="oldphoto" width="100px" src="{{$warehouse->photo}}">
									@error('photo')
										<div class="text text-danger">{{$message}}</div>
									@enderror
								</div>
							</div>
							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="stock">Stock/qty 
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" id="stock" name="stock" class="form-control" value="{{$warehouse->stock_qty}}">
								</div>
							</div>
							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="unit">Unit <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" id="unit" name="unit" class="form-control @error('unit') is-invalid @enderror" value="@error('unit') {{old('unit')}} @else {{$warehouse->UOM}} @enderror">
									@error('unit')
										<div class="text text-danger">{{$message}}</div>
									@enderror
								</div>
							</div>
							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="ordertime">Order time
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" id="ordertime" name="ordertime" class="form-control" value="{{$warehouse->order_time_duration}}">
								</div>
							</div>
							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="factor">Safety Factor
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" id="factor" name="factor" class="form-control" value="{{$warehouse->stock_safety_factor}}">
								</div>
							</div>
							<div class="ln_solid"></div>
							<div class="item form-group">
								<div class="col-md-6 col-sm-6 offset-md-3">
									<a href="{{route('materials.index')}}" class="btn btn-primary" type="button">Cancel</a>
									{{-- <button class="btn btn-primary" type="reset">Reset</button> --}}
									<button type="submit" class="btn btn-success">Submit</button>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
</div>	
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(function(){

		$(document).on('change',"input[name='photo']",function(){
			var myVal = URL.createObjectURL(event.target.files[0]);
			$('#oldphoto').attr('src',myVal);
		})

	})
</script>
@endsection