@extends('finance.staff.master')

@section('body')
@php

  date_default_timezone_set("Asia/Rangoon");
  $today= date('Y-m-d',strtotime('today'));

@endphp
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
										<li><a href="{{route('finance.staff.home')}}"><i class="fa fa-reply"> Back</i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
										

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Bank Name<span class="required">*</span>
											</label>
											<div class="col-md-4 col-sm-4">
												<select class="form-control" id="bank" name="bankname">
													<option>Choose option</option>
													@foreach($account as $account)
													@if($account->id!=1)
														<option id={{$account->id}}>
															{{$account->bank}}</option>
													@endif
													@endforeach
												</select>
												
											</div>
										</div>
										<form id="demo-form2" action="{{route('account.addbalance')}}" method="POST"data-parsley-validate class="form-horizontal form-label-left">
										@csrf
              							@method('GET')
              							<input type="hidden" name="id" value="{{$account->id}}">

              							
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Account Type<span class="required">*</span>
											</label>
											<div class="col-md-4 col-sm-4 " >
												<input type="text" name="accounttype" class="form-control" id="actype" disabled="">
												
												
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Account Number<span class="required">*</span>
											</label>
											<div class="col-md-4 col-sm-4 " >
												<input type="text" class="form-control" name="accountno" id="accountno" disabled="">
											</div>
										</div>

										
											<div class="form-group row">
					                        <label class="col-form-label col-md-3 col-sm-3 label-align">Ammount</label>
					                        <div class="col-md-4 col-sm-4">
					                          <input type="number" class="form-control" id="ammount" name="ammount">
					                        </div>
					                      </div>
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button type="submit" class="btn btn-success">Submit</button>
												<button class="btn btn-outline-danger" type="reset">Cancel</button>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
	</div>

	 	{{-- var bank=$('#bank').val();

	// 	$.ajax(
	// 	{
	// 		method:'POST',
	// 		url:"{{route('account.newbudget')}}",
	// 		data:{
	// 			bank:bank,
	// 		},
	// 		dataType:'json',


	// 		success:function(response)
	// 		{
	// 			//console.log(response);
	// 			var data= JSON.parse(response);
	// 			var account='';
	// 			account +=`<select class="form-control">
	// 							<option>Choose option</option>
								
	// 						</select>`;
									
	// 		$.each(data,function(i,v){
	// 			if(v)
	// 			{
	// 				var accounttype=v.type;
					
					

	// 				accountnoresultDiv +=`<option>{{$account->type}}</option>`;

	// 			}

	// 	})

	// $('#accountno').html(accountnoresultDiv);
		
// 	}
// })
// });

    
     


	{{-- <script type="text/javascript">
		$(document).ready(function(){
			

			function fetch_accountno(query = '')
			{

				$.ajax({
					url:"{{route('account.fetch_accountno')}}",
					method:'GET',
					data:{query:query},
					dataType:'json',
					success:function(data)
					{
						$('#accountno').html(data.account_no)// table data 

					}
				})
			}

			$(document).on('keyup','#bank',function(){
				var query= $(this).val();
				fetch_accountno(query);

			});

		});
	</script> --}}
@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			 
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

	
		$("#bank").on('change',function(){
			var bank =$(this).children(":selected").attr("id");
			
			$.ajax(
				{
			method:'GET',
			url:"{{route('account.addtype')}}",
			data:{
				bank:bank
			},
			// // dataType:'json',
			
			success:function(data)
	 		{
	 			if(data){
	 			 var array = JSON.parse(data);
	 			 // console.log(array.type);
	 			 $('#actype').val(array.type);
	 			 $('#accountno').val(array.acc_number);
	 			}



	 		}
		});
		});

		


		// 	 $.ajax(
		// {
		// 	method:'POST',
			// url:"",
		// 	data:{
		// 		bank:bank,
		// 	},
		// 	dataType:'json',
			
		// 	success:function(response)
	 // 		{
	 // 			//console.log(response);
	 // 		}
		// });
			 


		})
	</script>
@endsection