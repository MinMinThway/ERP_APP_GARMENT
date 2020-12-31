@extends('finance.staff.master')

@section('body')

<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Budgets</h3>
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
									<h2>Add Budgets</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class=""><i class="fa fa-reply"> Back</i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Bank Name<span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control">
													<option>Choose option</option>
													@foreach($account as $account)
														<option>{{$account->bank}}</option>
													@endforeach
												</select>
												
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Account Type<span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												
												
												<select class="form-control">
													<option>Choose option</option>
													@foreach($account as $account)
													{{-- <option>{{$account->type}}</option> --}}
													@endforeach
												</select>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Account Number<span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 " id="accountno">
												
											</div>
										</div>
											<div class="form-group row">
					                        <label class="col-form-label col-md-3 col-sm-3 label-align">Ammount</label>
					                        <div class="col-md-6 col-sm-6">
					                          <input type="text" class="form-control" data-inputmask="'mask' : '999-999-999-999'">
					                          
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

	<script type="text/javascript">
		$(document).ready(function(){
			fetch_accountno();

			function fetch_accountno(query = '')
			{

				$.ajax({
					url:"{{route('account.fetch_accountno')}}",
					method:'GET',
					data:{query:query},
					dataType:'json',
					success:function(data)
					{
						$('#accountno').html(data.account_no)
					}
				})
			}

			$(document).on()

		})
	</script>
@endsection
