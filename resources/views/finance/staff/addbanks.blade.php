@extends('finance.staff.master')

@section('body')
	<!-- page content -->
	<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Accounts</h3>
						</div>

						<div class="title_right">
							<div class="col-md-5 col-sm-5  form-group pull-right top_search">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search for...">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button">Go!</button>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Add Banks</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a href="{{route('account.home')}}"><i class="fa fa-reply"> Back</i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form id="demo-form2" action="{{route('account.store')}}" method="POST"data-parsley-validate class="form-horizontal form-label-left">
										@csrf
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="bankname">Bank Name<span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="bankname" id="bankname" required="required" class="form-control @error('bankname') is-invalid @enderror" value="{{old('bankname')}}">

												@error('bankname')
					                                <div class="alert alert-danger">{{ $message }}</div>
					                            @enderror

											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="accounttype">Account Type<span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6">
												<input type="text" id="accounttype" name="accounttype" required="required" class="form-control @error('accounttype') is-invalid @enderror" value="{{old('accounttype')}}">

												@error('accounttype')
					                                <div class="alert alert-danger">{{ $message }}</div>
					                            @enderror
											</div>
										</div>
										<div class="item form-group">
					                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="accountno">Account Number</label><span class="required">*</span>

					                        <div class="col-md-6 col-sm-6">
					                          <input type="text" id="accountno" name="accountno" required="required" class="form-control @error('accountno') is-invalid @enderror" value="{{old('accountno')}}">

												@error('accountno')
					                                <div class="alert alert-danger">{{ $message }}</div>
					                            @enderror
					                          
					                        </div>
					                     </div>
                     
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="balance">Balance<span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="balance" name="balance" required="required" class="form-control @error('balance') is-invalid @enderror" value="{{old('balance')}}">

												@error('balance')
					                                <div class="alert alert-danger">{{ $message }}</div>
					                            @enderror
											</div>
										</div>

										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button type="submit" class="btn btn-success">Submit</button>
												<button class="btn btn-primary" type="reset">Reset</button>
												<button class="btn btn-primary" type="reset">Cancel</button>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
	</div>
	
@endsection